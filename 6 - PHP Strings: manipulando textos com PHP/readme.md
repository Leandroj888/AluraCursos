# Links
- https://dias.dev/2022-02-13-extensoes-php/ `OK`
- https://cursos.alura.com.br/extra/alura-mais/trabalhando-com-multibyte-string-em-php-c64 `OK`
- https://www.php.net/manual/pt_BR/book.mbstring.php `OK`
- https://youtu.be/lntsVxPZibw `OK`
- https://regex101.com/


# Validar mbstring
Linux vêm instalado por padrão, para verificar os módulos instalado
```bash
php -m
```

No windows localize o php Ini
```bash
php --ini
```
Se não tiver load Configuration File acesse a pasta do php e renomeie o nome do arquivo `php.ini-development` para `php.ini`

busque nesse arquivo as seguintes linhas

```bash
;extension_dir = ext

;extension = mbstring
```

remova o ponto e virgula dela