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
    uses: ./33_Integracao_Continua_Pipeline_Docker_no_Github_Actions/.github/workflows/Docker.yml
```

Editamos esse Docker.yml dentro do próprio github para acessar o marktplace
