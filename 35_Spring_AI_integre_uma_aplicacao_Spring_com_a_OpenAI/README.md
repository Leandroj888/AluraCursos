# Endpoints
http://localhost:8080/categorizador?produto=Escova%20de%20Dentes
http://localhost:8080/gerador




# Sites

### Spring Project
https://spring.io/projects/spring-ai

### Spring Inicializer
https://start.spring.io/


### Prompt enginer 
https://developers.openai.com/api/docs/guides/prompt-engineering?api-mode=responses

### Tokenização Openai
https://platform.openai.com/tokenizer

### Default Ollama
http://docs.spring.io/spring-ai/reference/api/chat/ollama-chat.html#_chat_properties

# Aula 01

Spring CLI ou pelo site


## Requisições

- OpenAI - para comunicação com o llm
- Spring WEB - para comunicação restful
- Spring Boot DevTools - para recursos de livereload



## Iniciar app

mvn i
mvn spring-boot:run




## Instalar o Ollama no Fedora
Primeiro, confirme se o driver NVIDIA está funcionando:
nvidia-smi


Depois, instale o Ollama utilizando o instalador oficial:
curl -fsSL https://ollama.com/install.sh | sh


Confira se o serviço está ativo:
systemctl status ollama

Desabilitar a inicialização automática
sudo systemctl disable --now ollama

iniciar manualmente:
sudo systemctl start ollama



## Baixar nosso primeiro modelo

Baixar modelo
ollama pull qwen3:4b


Execute:
ollama run qwen3:4b


Faça uma pergunta:
Explique o que é injeção de dependências no Spring Boot.


Para encerrar a conversa, digite /bye.

Para verificar se o processamento está sendo executado na NVIDIA, enquanto o modelo estiver carregado, utilize outro terminal:
ollama ps


Observe a coluna PROCESSOR. O ideal é aparecer 100% GPU.
## Configurar o Spring AI
No seu projeto Maven, substitua a dependência do OpenAI pela do Ollama:
<dependency>
    <groupId>org.springframework.ai</groupId>
    <artifactId>spring-ai-starter-model-ollama</artifactId>
</dependency>


O projeto precisa utilizar uma versão compatível do Spring Boot e importar o BOM do Spring AI para gerenciar as versões das dependências.

No src/main/resources/application.yml:
spring.ai.ollama.base-url: http://localhost:11434
spring.ai.ollama.chat.model: qwen3:4b
spring.ai.ollama.chat.temperature: 0.7


# Aula 2

## Temperature
Definição: O parâmetro Temperature controla a aleatoriedade das respostas geradas pelo modelo.
Intervalo de valores: 0.0 a 2.0
Descrição: Valores mais baixos, como 0.5 ou 0.6, fazem com que o modelo produza respostas mais determinísticas e focadas, reduzindo a criatividade. Já valores mais altos, como 1.2 ou 1.5, aumentam a criatividade e a diversidade das respostas, mas também podem introduzir mais incoerência.
Uso: Use um valor baixo para tarefas que requerem respostas precisas e coerentes, como explicações técnicas. Use temperature alta para tarefas criativas, como escrita de histórias.
## Max Tokens
Definição: O parâmetro Maximum Tokens define o número máximo de tokens (palavras ou partes de palavras) na resposta gerada pelo modelo.
Intervalo: Depende do modelo utilizado. Normalmente tem um limite de 4096 ou 16384.
Descrição: Este parâmetro limita o comprimento da resposta. Por exemplo, se for definido como 50, a resposta não ultrapassará 50 tokens.
Uso: Ajuste de acordo com a necessidade da aplicação. Para respostas curtas e diretas, use um valor menor. Para respostas detalhadas, use um valor maior.
## TopP
Definição: O parâmetro TopP, também conhecido como núcleo de amostragem, controla a diversidade através da restrição do conjunto de candidatos para a próxima palavra.
Intervalo: 0.0 a 1.0
Descrição: Com TopP de 0.9, o modelo considera apenas os 90% dos candidatos mais prováveis (com base na sua probabilidade cumulativa) para a próxima palavra. Isso pode tornar as respostas mais variadas e menos previsíveis.
Uso: Use em conjunto com temperature para ajustar a criatividade e diversidade das respostas. Valores mais altos podem gerar respostas mais variadas.
## Frequency penalty
Definição: O parâmetro Frequency penalty aplica uma penalidade a palavras que já apareceram na resposta.
Intervalo: 0.0 a 2.0
Descrição: Valores positivos reduzem a probabilidade de repetir as mesmas palavras, incentivando a diversidade lexical. Valores negativos podem aumentar a probabilidade de repetição.
Uso: Utilize um valor alto quando quiser respostas com menor repetição de palavras, sendo útil em situações que requerem maior variação lexical.
## Presence penalty
Definição: O parâmetro Presence penalty penaliza a presença de determinadas palavras na resposta.
Intervalo: 0.0 a 2.0
Descrição: Similar ao Frequency penalty mas com foco na presença de palavras, não apenas na frequência. Valores altos desencorajam a inclusão de palavras presentes em contextos anteriores, enquanto valores baixos incentivam essa inclusão.
Uso: Ajuste para controlar a inclusão de certas palavras na resposta, mantendo ou alterando o contexto de forma mais flexível.
## Stop sequences
Definição: O parâmetro Stop sequences define uma ou mais sequências de caracteres que, ao serem encontradas, fazem com que o modelo interrompa a geração de texto.
Descrição: Pode ser uma string única ou uma lista de strings. Quando uma dessas sequências aparece na resposta gerada, a geração de texto é interrompida.
Uso: Use para delimitar respostas e evitar saídas excessivamente longas ou fora de contexto. Por exemplo, em um chatbot, você pode definir sequências de parada para garantir que o modelo responda de maneira concisa.


# Aula 3

Para contagem de tokens parece que o Spring AI já possui uma ferramenta, porém no curso é apresentada a **Jtokkit** https://jtokkit.knuddels.de/docs/getting-started, ele é muito bom para modelos OpenAi mas para outros pode ser usado para estimativas


2. Capturar automaticamente com Micrometer
Para monitorar todas as chamadas sem adicionar código em cada controller, o Spring AI oferece integração com Micrometer Observability.

Você pode utilizar:
- Spring Boot Actuator
- Micrometer
- Prometheus
- Grafana




# Aula 4 

## Instalação
``` bash
sudo dnf install -y git python3 python3-pip
``` 

### gerador de imagem
``` bash
cd ~/Documentos
git clone https://github.com/Comfy-Org/ComfyUI.git
cd ComfyUI
python3 -m venv .venv
source .venv/bin/activate
python -m pip install torch torchvision torchaudio \
  --extra-index-url https://download.pytorch.org/whl/cu130
python -m pip install -r requirements.txt
curl -L \
  "https://huggingface.co/Comfy-Org/stable-diffusion-1.5/resolve/main/v1-5-pruned-emaonly.safetensors" \
  -o models/checkpoints/v1-5-pruned-emaonly.safetensors

``` 

### Conversor de modelo
``` bash
cd ~/Documentos
git clone https://github.com/lunar-me/comfy-openai.git
cd comfy-openai
python3 -m venv .venv
source .venv/bin/activate
python -m pip install -r requirements.txt
cp .env.example .env
```
No .env, configure:

## Verificar
``` bash
python -c "import torch; print(torch.cuda.is_available()); print(torch.cuda.get_device_name(0) if torch.cuda.is_available() else 'GPU indisponível')"
```

## Iniciar

### Conversor de modelo
``` bash
cd ~/Documentos/comfy-openai
source .venv/bin/activate
python main.py 
```

### gerador de imagem
``` bash
cd ~/Documentos/
python main.py --listen 127.0.0.1 --port 8188
```
