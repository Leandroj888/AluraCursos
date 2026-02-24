

# Links
- https://www.hipsters.tech/praticas-de-orientacao-a-objetos-hipsters-129/
- https://www.php.net/manual/en/language.types.integer.php#language.types.integer.casting `ok`
- https://www.hipsters.tech/tabela-de-hash-hipsters-ponto-tech-222/ `ok`
- https://www.alura.com.br/artigos/trabalhando-com-arrays-em-php `ok`

`Essa configuração faz o PHP não ser mais intepretado só compilado, ideal para ambiente de produção`
php -dopcache.validate_timestamps=0 -S 0.0.0.0:8123

`Resetar o opcache`
``` PHP
<?php opcache_reset()
```