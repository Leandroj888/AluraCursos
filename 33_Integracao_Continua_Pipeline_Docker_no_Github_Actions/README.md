# 1 Rotinas existentes

Permite diversivicar ambiente e versões
```yaML
name: build
  build_33:
    runs-on: ${{ matrix.os }}
    strategy:
      matrix:
        os: ['ubuntu-latest', 'ubuntu-22.04']
```


Imagens de SO disponiveis para o GitHub Actions
https://github.com/actions/runner-images


# 2 Preparando o conatainer

Criando o Dockerfile

```Dockerfile

FROM ubuntu:latest -> Imagem que será utilizada

EXPOSE 8000 -> Porta que será exposta

WORKDIR /app -> Local a ser trabalhado

COPY ./main main -> Copia do arquivo compilado para dentro do container

CMD ["./main"] -> Comando executado

```


Compilar go usando docker
```bash
docker run --rm -v ${PWD}:/app -w /app golang:1.22-alpine go build -o main main.go
```

montar container
``` bash
docker build .
```

# 3 Container e CI

Criamos um repasse para outra rotina
``` yml
  docker:
    needs: build_33
    uses: ./33_Docker.yml
```

Editamos esse Docker.yml dentro do próprio github para acessar o marktplace
É necessário colocar todos os arquivos de rotina no .github\workflows na raiz do repositório, caso contrário o sistema pode acabar não identificando os arquivos

# 4 Segredos e Chaves

secrets: inherit - deve ser usado no yaml principal para poder passar os screts para os outros arquivos
``` yml
  docker:
    needs: build_33
    uses: ./33_Docker.yml
    secrets: inherit
```

# 5 Artefatos

É uma forma de levar informações de um ambiente para outro nas pipes

## Para saber mais: 2 artefatos iguais

Sempre que salvamos um artefato, um arquivo é criado no Github, porém não podemos ter dois arquivos com o mesmo nome, igual não podemos ter 2 arquivos com o mesmo nome no nosso computador.

Porém, se tivermos duas ou mais rotinas, ou uma única rotina com mais de um ambiente sendo executado, como no caso das estratégias de matrizes, fazendo a criação de um artefato, podemos encontrar um erro, onde o github actions não consegue fazer salvar o artefato que foi criado por último, interrompendo a execução.

Então, sempre que você for gerar um artefato, tome cuidado para verificar se não tem algum outro artefato com o mesmo nome, e se você não está executando alguma estratégia de múltiplos ambientes durante a geração do artefato.





Tarciso

