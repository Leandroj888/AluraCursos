# 1 Recapitulando

https://github.com/alura-cursos/3983-integracao-continua

## Integração Continua
- Unificar as mudanças com código existente;

iniciar 
``` bash
docker compose up
```

# 2 Preparando o Terreno

Ferramenta de Qualidade
- Linter
- 
``` bash
docker run --rm -it -v "${PWD}:/app" -w /app golangci/golangci-lint golangci-lint run controllers/ database/ models/ routes/
```

- Rodar Testes
``` bash
docker compose exec app go test main_test.go
```

- Instalar make no windows (usar powershell como admin)
``` bash
choco install make -y
```

Makefile = Nome de tarefas

CI - Continuos Integration


# 3 GitHub Actions

- Servidor para execuções
- Deployers
- Integração continua
- Alternativas
    - Jenkins
    - TravisCI 

``` bash
git branch -c pull_request
git checkout pull_request
```

ou 

``` bash
git switch -c pull_request
```

# 4 Protegendo Segredos

- Usamos o Secrets de GitHub Actions

GitHub -> Project -> Settings -> Secrets And Variable -> Actions -> Repository Secrets

Depois definir no yaml usando ${{secrets.NAME}}

``` yaml
    - name: Test
      run: DB_HOST=${{secrets.DB_HOST}} DB_PASSWORD=${{secrets.DB_PASSWORD}} DB_USER=${{secrets.DB_USER}} DB_NAME=${{secrets.DB_NAME}} DB_PORT=${{secrets.DB_PORT}} go test -v main_test.go
```