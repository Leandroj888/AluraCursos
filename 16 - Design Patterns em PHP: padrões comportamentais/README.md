# Link

https://www.alura.com.br/artigos/modelagem-oo-linguagem-oo `ok`
https://cursos.alura.com.br/extra/hipsterstech/praticas-de-orientacao-a-objetos-hipsters-129-a453 `ok`
https://floating-point-gui.de/ `ok`
https://refactoring.guru/pt-br/design-patterns/strategy `ok`
https://refactoring.guru/pt-br/design-patterns/chain-of-responsibility `ok`

# Criar Namespace

criar a pasta src
criar o arquivo `composer.json` com o seguinte conteúdo

```json
{
  "autoload": {
    "psr-4": {
      "Alura\\DesignPattern\\": "src/"
    }
  }
}
```

executar o comando

```bash
composer dump-autoload
```

## debugar

`XDEBUG_TRIGGER=1 php teste.php`
`http://localhost:8080/teste.php?XDEBUG_TRIGGER=1`

```bash
composer update
vendor/bin/phpunit

#php -S 0.0.0.0:8080 -t src
```
