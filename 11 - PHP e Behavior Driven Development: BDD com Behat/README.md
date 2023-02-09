# Leandro Readme

## Links
https://cucumber.io/docs/gherkin/ `ok`

## Comandos
```bash
composer install
php bin/doctrine orm:schema-tool:create
php bin/doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('email@example.com', '\$argon2i\$v=19\$m=65536,t=4,p=1\$WHpBb1FzTDVpTmQubU55bA\$jtZiWSSbmw1Ru4tYEq1SzShrMu0ap2PjblRQRubNPgo');"
php -S 0.0.0.0:8080 -t public
```

## Login
- Usuário  `email@example.com` 
- Senha `123456`.

## Extensão vsCode
Cucumber (Gherkin) Full Support
Cucumber for Visual Studio Code

## Behat
Ferramenta para automatizar testes de comportamentos / testes do negócio

Automatizar testes escritos utilizando Gherkin

### Instalação
```bash
composer require --dev behat/behat
```

### Folder
Criar uma pasta no projeto chamada de `features`

### Executar
```bash
php vendor/bin/behat --init
```

### Validar / Criar os que não existe, porém sem executar
```bash
php vendor/bin/behat --append-snippets --dry-run
```

### manipular banco
```bash
php vendor/bin/doctrine orm:schema-tool:update --dump-sql
php vendor/bin/doctrine orm:schema-tool:update --force
```


# Alura Readme
## Introdução ao MVC com PHP

Repositório que contém um simples projeto de cadastro de cursos em PHP usando Doctrine ORM e os pacotes de PSR-7 nyholm/psr7 e nyholm/psr7-server.

### Ambiente necessário

Para executar este sistema é necessário ter instalado:

- Composer
- PHP (>= 8.1)
    - PDO SQLite

### Iniciar o sistema

Antes de mais nada, é preciso instalar os componentes utilizados pelo sistema. Para isso, execute:

```
composer update
```

Para inicializar o sistema, o primeiro passo é criar o banco de dados. Para isso, execute o seguinte comando que criará a estrutura do banco de dados SQLite: 
```
php bin/doctrine orm:schema-tool:create
```

Agora vamos inserir um usuário com e-mail `email@example.com` e senha `123456`.

### Em ambientes Unix (incluindo WSL e Git Bash no Windows):

```
php bin/doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('email@example.com', '\$argon2i\$v=19\$m=65536,t=4,p=1\$WHpBb1FzTDVpTmQubU55bA\$jtZiWSSbmw1Ru4tYEq1SzShrMu0ap2PjblRQRubNPgo');"
```

### Em ambientes Windows (PowerShell):
```
php bin/doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('email@example.com', '`$argon2i`$v=19`$m=65536,t=4,p=1`$WHpBb1FzTDVpTmQubU55bA`$jtZiWSSbmw1Ru4tYEq1SzShrMu0ap2PjblRQRubNPgo');"
```

### Em ambientes Windows (CMD):
```
php bin/doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('email@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WHpBb1FzTDVpTmQubU55bA$jtZiWSSbmw1Ru4tYEq1SzShrMu0ap2PjblRQRubNPgo');"
```

## Finalizando
Tendo feito isso, basta subir um servidor de testes. Isso pode ser feito com:

```
php -S localhost:8080 -t public
```

Pronto! Basta acessar no seu navegador o endereço http://localhost:8080/ e começar a interagir com o sistema.