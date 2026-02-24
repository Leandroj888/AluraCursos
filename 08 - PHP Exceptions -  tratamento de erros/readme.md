# Links
https://www.youtube.com/watch?v=cjiG7wB5C9Y `ok`
https://www.php.net/manual/pt_BR/spl.exceptions.php `ok`
https://www.youtube.com/watch?v=cjiG7wB5C9Y `ok`
https://www.youtube.com/watch?v=YO3PRChajWc `ok`
https://www.youtube.com/watch?v=Fcq2UhZkj_E `ok`
https://www.php.net/manual/pt_BR/language.errors.basics.php `ok`


# Exibir a pilha de execução

Não interrompe o programa como um errro mas mostra as informações

```php
debug_backtrace()
```

## exemplo
```php
print_r(debug_backtrace());
```
```bash
Array
(
    [0] => Array
        (
            [file] => /home/leandro/AluraCursos/8-PHP Exceptions: tratamento de erros/pilha.php
            [line] => 8
            [function] => funcao2
            [args] => Array
                (
                )

        )

    [1] => Array
        (
            [file] => /home/leandro/AluraCursos/8-PHP Exceptions: tratamento de erros/pilha.php
            [line] => 24
            [function] => funcao1
            [args] => Array
                (
                )

        )

)
```


# exibir todos erros

`PHP 8 - Já vai mostrar todos os erros`

No php ini em 

```bash
php --ini
```

ou via código]

```php
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL );
```

E_ALL - todos erros
E_NOTICE - error do tipo notice
E_STRICT - não segue as melhores práticas
E_DEPRECATED - Descontinuado


boa combinação ambiente produção - ideal mandar no php.ini 

```php
ini_set('display_errors', 0); // Não mostra erro no console / tela
ini_set('log_errors', 1); // faz o log dos erros
ini_set('error_log', "app.log"); // arquivo para armazenar os erros
```