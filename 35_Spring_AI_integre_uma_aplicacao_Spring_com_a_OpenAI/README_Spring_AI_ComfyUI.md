# Geração local de imagens com Spring AI, ComfyUI e Stable Diffusion 1.5

Este guia documenta a integração utilizada no projeto de estudos **Ecomart** para gerar imagens localmente com **Spring Boot + Spring AI**, utilizando o **Stable Diffusion 1.5** executado pelo **ComfyUI** e uma camada compatível com a API de imagens da OpenAI (`comfy-openai`). Não é necessário contratar a API da OpenAI para este fluxo local.

> **Estado da implementação:** a geração foi validada localmente via ComfyUI, via `comfy-openai` e via `ImageModel` do Spring AI. Neste ambiente, a URL de arquivo devolvida pelo adaptador resultou em HTTP 404 e o campo Base64 chegou nulo ao Spring AI. O endpoint Java exibiu a imagem no navegador usando, como solução provisória, um arquivo PNG salvo no diretório de saída do ComfyUI. Esse último passo **não é seguro para requisições simultâneas** e deve ser substituído antes de colocar a aplicação em produção.

## 1. Tecnologias utilizadas

| Componente | Uso | Configuração local |
| --- | --- | --- |
| Java 21 | Linguagem | JDK 21 |
| Spring Boot 4.2.0 | Aplicação web | `localhost:8080` |
| Spring AI 2.1.0-M1 | `ChatClient` e `ImageModel` | Dependências Maven |
| Ollama + Qwen 3 4B | Chat (opcional para imagens) | `localhost:11434` |
| ComfyUI | Execução do Stable Diffusion | `127.0.0.1:8188` |
| Stable Diffusion 1.5 | Modelo de imagem | `v1-5-pruned-emaonly.safetensors` |
| comfy-openai | Adaptador OpenAI-compatible | `127.0.0.1:8000` |

Os testes foram feitos em Fedora com GPU NVIDIA de 8 GB. Os caminhos abaixo seguem a instalação utilizada neste exemplo, sob `~/Documentos/`.

```text
Spring Boot :8080
  └── Spring AI ImageModel (OpenAI-compatible)
       └── comfy-openai :8000
            └── ComfyUI :8188
                 └── Stable Diffusion 1.5
                      └── PNG salvo em ComfyUI/output/
```

## 2. Instalação do ComfyUI

Se ainda não estiver instalado:

```bash
sudo dnf install -y git python3 python3-pip
cd ~/Documentos
git clone https://github.com/Comfy-Org/ComfyUI.git
cd ComfyUI
python3 -m venv .venv
source .venv/bin/activate
```

Instale o PyTorch compatível com sua versão de Python, driver e GPU seguindo as instruções oficiais: https://pytorch.org/get-started/locally/ . Em seguida:

```bash
python -m pip install -r requirements.txt
python -c 'import torch; print("CUDA disponível:", torch.cuda.is_available())'
python main.py --listen 127.0.0.1 --port 8188
```

Abra `http://127.0.0.1:8188`. Mantenha esse terminal aberto.

### Modelo SD 1.5

Obtenha um arquivo **válido e completo** `v1-5-pruned-emaonly.safetensors` do repositório de Stable Diffusion 1.5 no Hugging Face, respeitando a licença do modelo. Coloque-o em:

```text
~/Documentos/ComfyUI/models/checkpoints/v1-5-pruned-emaonly.safetensors
```

Confira o arquivo antes de executar. O download incompleto causou este erro real durante a implementação:

```text
The safetensors file is corrupt/incomplete.
Tensor ... extends past the end of the file.
```

Uma verificação possível, com a virtualenv do ComfyUI ativada, é:

```bash
python - <<'PY'
from safetensors import safe_open
path = 'models/checkpoints/v1-5-pruned-emaonly.safetensors'
with safe_open(path, framework='pt') as model:
    print('Tensores:', len(model.keys()))
PY
```

## 3. Workflow que gerou a primeira imagem

Crie o arquivo `~/Documentos/comfy-openai/workflows/image_sd15_text_to_image.json` com o conteúdo abaixo. Este é o workflow **em formato de API** que foi validado na prática:

```json
{
  "1": {"class_type": "CheckpointLoaderSimple", "inputs": {"ckpt_name": "v1-5-pruned-emaonly.safetensors"}},
  "2": {"class_type": "CLIPTextEncode", "inputs": {"text": "A beautiful black cat, realistic photography", "clip": ["1", 1]}},
  "3": {"class_type": "CLIPTextEncode", "inputs": {"text": "blurry, low quality, distorted", "clip": ["1", 1]}},
  "4": {"class_type": "EmptyLatentImage", "inputs": {"width": 512, "height": 512, "batch_size": 1}},
  "5": {"class_type": "KSampler", "inputs": {"model": ["1", 0], "positive": ["2", 0], "negative": ["3", 0], "latent_image": ["4", 0], "seed": 42, "steps": 20, "cfg": 7.0, "sampler_name": "euler", "scheduler": "normal", "denoise": 1.0}},
  "6": {"class_type": "VAEDecode", "inputs": {"samples": ["5", 0], "vae": ["1", 2]}},
  "7": {"class_type": "SaveImage", "inputs": {"images": ["6", 0], "filename_prefix": "SpringAI_Test"}}
}
```

### Testar diretamente no ComfyUI

Salve esse mesmo conteúdo como `workflow.json` em um diretório conveniente, entre nele e execute:

```bash
python3 - <<'PY'
import json
import urllib.request

with open('workflow.json', encoding='utf-8') as file:
    workflow = json.load(file)

request = urllib.request.Request(
    'http://127.0.0.1:8188/prompt',
    data=json.dumps({'prompt': workflow}).encode('utf-8'),
    headers={'Content-Type': 'application/json'},
)

with urllib.request.urlopen(request) as response:
    print(response.read().decode('utf-8'))
PY
```

A resposta contém `prompt_id`, mas isso **significa apenas que a tarefa foi aceita**. Confira a conclusão pelo histórico:

```bash
curl -s 'http://127.0.0.1:8188/history/SEU_PROMPT_ID' | python3 -m json.tool
```

Quando concluída, a imagem deve aparecer em `~/Documentos/ComfyUI/output/` como `SpringAI_Test_00001_.png` ou outro número sequencial.

## 4. Instalar e configurar o adaptador comfy-openai

Em outro terminal:

```bash
cd ~/Documentos
git clone https://github.com/lunar-me/comfy-openai.git
cd comfy-openai
python3 -m venv .venv
source .venv/bin/activate
python -m pip install -r requirements.txt
cp .env.example .env
```

Configure o `.env` com os parâmetros correspondentes à sua instalação. Por exemplo:

```dotenv
COMFY_URL=http://127.0.0.1:8188
API_PORT=8000
BASE_URL=http://127.0.0.1:8000
WORKFLOW_REGISTRY=workflows/models.json
```

> Confira outras variáveis, inclusive qualquer autenticação, no `.env.example` da versão efetivamente clonada. A chave `local-key` abaixo é somente um valor de desenvolvimento, não uma credencial de segurança para acesso público.

### Registrar o modelo em `workflows/models.json`

Adicione a entrada `sd15` ao objeto JSON já existente (não substitua os demais modelos, nem crie outro objeto raiz):

```json
"sd15": {
  "type": "image",
  "workflow": "workflows/image_sd15_text_to_image.json",
  "nodes": {
    "prompt": "2",
    "negative_prompt": "3",
    "seed": "5",
    "width": "4",
    "height": "4",
    "latent": "4",
    "steps": "5",
    "cfg": "5"
  },
  "sizes": ["512x512"],
  "owned_by": "local"
}
```

Esses IDs correspondem ao workflow validado: `2` = prompt positivo, `3` = negativo, `4` = resolução/latent e `5` = sampler. **A entrada acima reproduz o registro utilizado no experimento; o formato exato das chaves de `nodes` pode depender da versão do adaptador.**

Valide os JSONs:

```bash
python3 -m json.tool workflows/models.json > /dev/null
python3 -m json.tool workflows/image_sd15_text_to_image.json > /dev/null
```

Inicie o adaptador:

```bash
python main.py
```

### Testar sem Java

Liste os modelos:

```bash
curl -s http://127.0.0.1:8000/v1/models \
  -H 'Authorization: Bearer local-key' | python3 -m json.tool
```

Gere uma imagem:

```bash
curl -sS --max-time 300 \
  http://127.0.0.1:8000/v1/images/generations \
  -H 'Authorization: Bearer local-key' \
  -H 'Content-Type: application/json' \
  -d '{"model":"sd15","prompt":"A beautiful white cat, realistic photography","size":"512x512","n":1,"response_format":"url"}'
```

**Este teste da API funcionou na configuração original.** Só avance quando o adaptador estiver conseguindo gerar imagens.

## 5. Configurar Spring AI

No `pom.xml` (com as versões gerenciadas pelo BOM do Spring AI):

```xml
<dependency>
    <groupId>org.springframework.ai</groupId>
    <artifactId>spring-ai-starter-model-ollama</artifactId>
</dependency>
<dependency>
    <groupId>org.springframework.ai</groupId>
    <artifactId>spring-ai-starter-model-openai</artifactId>
</dependency>
```

No `src/main/resources/application.properties`:

```properties
# Ollama para chat (opcional se o projeto só gera imagens)
spring.ai.model.chat=ollama
spring.ai.ollama.base-url=http://127.0.0.1:11434
spring.ai.ollama.chat.model=qwen3:4b

# ImageModel com o adaptador local
spring.ai.model.image=openai
spring.ai.openai.image.base-url=http://127.0.0.1:8000/v1
spring.ai.openai.image.api-key=local-key
spring.ai.openai.image.model=sd15
spring.ai.openai.image.size=512x512
spring.ai.openai.timeout=300s
```

**Atenção à versão:** o exemplo foi testado com Spring AI `2.1.0-M1`. No Spring AI recente, a seleção do modelo usa `spring.ai.model.chat=ollama`, em vez da propriedade antiga `spring.ai.openai.chat.enabled=false`, que gerou aviso no VS Code. Isso também resolveu a ambiguidade entre os beans `ollamaChatModel` e `openAiChatModel`.

A URL com `/v1` é importante: sem a rota correta, observou-se `405 Method Not Allowed` nas chamadas de imagem.

## 6. Controller para exibir PNG no navegador — solução local confirmada

No experimento, o Spring AI devolveu:

```text
Image URL: http://127.0.0.1:8000/v1/images/<identificador>.png
Base64 presente: false
```

O navegador, entretanto, recebeu HTTP 404 nessa URL, embora o arquivo PNG existisse na pasta `ComfyUI/output`. Para **reproduzir a solução que funcionou localmente**, o controller abaixo lê a imagem salva com prefixo `SpringAI_Test` e data de modificação posterior ao início da requisição.

> **AVISO:** esse código é apenas um _workaround_ para desenvolvimento local, com requisições sequenciais. Ele pode retornar uma imagem de outra requisição concorrente e depende da pasta compartilhada com o ComfyUI. Não use em produção ou com múltiplos usuários.

`src/main/java/br/com/alura/ecomart/controller/ImageController.java`:

```java
package br.com.alura.ecomart.controller;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.time.Instant;
import java.util.Comparator;
import java.util.stream.Stream;

import org.springframework.ai.image.ImageModel;
import org.springframework.ai.image.ImagePrompt;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/images")
public class ImageController {

    private static final String FILE_PREFIX = "SpringAI_Test";
    private final ImageModel imageModel;

    public ImageController(ImageModel imageModel) {
        this.imageModel = imageModel;
    }

    @GetMapping(value = "/generate", produces = MediaType.IMAGE_PNG_VALUE)
    public ResponseEntity<byte[]> generate(@RequestParam String prompt) throws IOException {
        Path outputDirectory = Path.of(
                System.getProperty("user.home"), "Documentos", "ComfyUI", "output");
        Instant startedAt = Instant.now();

        // A chamada é síncrona: o adaptador aguarda a geração no ComfyUI.
        imageModel.call(new ImagePrompt(prompt));

        Path image = findLatestImage(outputDirectory, startedAt);
        byte[] bytes = Files.readAllBytes(image);

        return ResponseEntity.ok()
                .contentType(MediaType.IMAGE_PNG)
                .body(bytes);
    }

    private Path findLatestImage(Path directory, Instant startedAt) throws IOException {
        try (Stream<Path> entries = Files.list(directory)) {
            return entries
                    .filter(Files::isRegularFile)
                    .filter(path -> path.getFileName().toString().startsWith(FILE_PREFIX))
                    .filter(path -> path.getFileName().toString().endsWith(".png"))
                    .filter(path -> {
                        try {
                            return !Files.getLastModifiedTime(path).toInstant().isBefore(startedAt);
                        } catch (IOException exception) {
                            return false;
                        }
                    })
                    .max(Comparator.comparingLong(path -> {
                        try {
                            return Files.getLastModifiedTime(path).toMillis();
                        } catch (IOException exception) {
                            return Long.MIN_VALUE;
                        }
                    }))
                    .orElseThrow(() -> new IllegalStateException(
                            "Nenhuma imagem nova foi encontrada no diretório do ComfyUI."));
        }
    }
}
```

Esse exemplo pressupõe que o adaptador conclua a gravação do arquivo antes de `imageModel.call` retornar. Se a sua versão responder antes, será necessário implementar espera controlada e tratamento de timeout. O caminho local também deve ser parametrizado antes de distribuir a aplicação.

Execute:

```bash
./mvnw spring-boot:run
```

Acesse no navegador (ou em ferramenta HTTP):

```text
http://localhost:8080/images/generate?prompt=A%20beautiful%20white%20cat
```

O endpoint retorna `Content-Type: image/png`, permitindo a exibição direta da imagem.

## 7. Problemas encontrados e soluções

| Sintoma | Causa identificada | Como resolver |
| --- | --- | --- |
| `ERR_CONNECTION_REFUSED` na porta 8188 | ComfyUI não estava em execução | Iniciar `python main.py --listen 127.0.0.1 --port 8188` |
| Nós vermelhos no editor | Workflow selecionava componentes ausentes do Z-Image | Utilizar o workflow mínimo SD 1.5 e o checkpoint correto |
| `safetensors file is corrupt/incomplete` | Download do checkpoint incompleto | Substituir o arquivo e validar seu conteúdo |
| `/prompt` retorna `prompt_id`, mas não há imagem | A solicitação foi aceita, mas a execução pode falhar | Consultar `/history/{prompt_id}` |
| `KeyError` ao consultar um ID antigo | Entrada de histórico indisponível | Salvar o JSON do workflow ou usar o ID da nova execução |
| Dois beans `ChatModel` encontrados | Starters de Ollama e OpenAI habilitados simultaneamente | Selecionar `spring.ai.model.chat=ollama` |
| HTTP 405 na geração com Spring AI | Base URL não correspondia à API do adaptador | Verificar `/v1/images/generations` e a propriedade `spring.ai.openai.image.base-url` |
| `getB64Json()` retornou `null` | O `ImageModel` expôs URL, não Base64, nesse teste | Inspecionar `getUrl()` e `getB64Json()` |
| URL `/v1/images/<arquivo>.png` retornou 404 | URL devolvida não correspondeu à rota que servia o arquivo | Diagnosticar a configuração `BASE_URL` e a rota `/images/{file}`; provisoriamente ler o arquivo local |

## 8. Melhorias necessárias antes de produção

1. **Corrigir a entrega de arquivos pelo adaptador.** A documentação do `comfy-openai` informa `GET /images/{file}`; a URL observada usou `/v1/images/{file}`. Revise `BASE_URL` e o código da versão instalada antes de manter o workaround.
2. **Vincular cada imagem à sua requisição.** Evite escolher o PNG mais recente: use o identificador retornado pelo ComfyUI ou um nome exclusivo por geração.
3. **Separar camadas.** Mantenha o controller HTTP simples, encapsule a geração em um service e o acesso a arquivos/URLs em um componente próprio.
4. **Adicionar limites.** Configure tamanho máximo dos prompts, concorrência, tempo limite, tamanho máximo das imagens e limpeza de arquivos.
5. **Proteger os serviços.** Preserve ComfyUI e adaptador vinculados ao `127.0.0.1` no ambiente de desenvolvimento; não exponha diretamente essas APIs sem autenticação e controle de acesso.
6. **Respeitar licenças.** Verifique as licenças de modelos, bibliotecas e checkpoints antes da redistribuição.

## 9. Inicialização e verificação rápida

Abra terminais separados:

```bash
# Terminal 1 — ComfyUI
cd ~/Documentos/ComfyUI
source .venv/bin/activate
python main.py --listen 127.0.0.1 --port 8188
```

```bash
# Terminal 2 — comfy-openai
cd ~/Documentos/comfy-openai
source .venv/bin/activate
python main.py
```

```bash
# Terminal 3 — Spring Boot
cd /caminho/para/ecomart
./mvnw spring-boot:run
```

Verificações:

```bash
curl -s http://127.0.0.1:8188/system_stats | python3 -m json.tool
curl -s http://127.0.0.1:8000/v1/models | python3 -m json.tool
curl -G 'http://localhost:8080/images/generate' \
  --data-urlencode 'prompt=A black cat, realistic photography' \
  --output generated.png
```

O **Ollama não é necessário para geração de imagem**. Inicie-o apenas se também estiver testando endpoints de chat com o Qwen 3.

## Referências

- [ComfyUI — repositório oficial](https://github.com/Comfy-Org/ComfyUI)
- [ComfyUI — documentação](https://docs.comfy.org/)
- [comfy-openai — adaptador comunitário](https://github.com/lunar-me/comfy-openai)
- [Spring AI — geração de imagens OpenAI](https://docs.spring.io/spring-ai/reference/api/image/openai-image.html)
- [PyTorch — instalação](https://pytorch.org/get-started/locally/)

---

**Escopo:** demonstração técnica local para fins educacionais, com as limitações de entrega e concorrência descritas acima.
