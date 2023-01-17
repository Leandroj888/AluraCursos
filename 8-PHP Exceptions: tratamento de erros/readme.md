# Links
https://www.youtube.com/watch?v=cjiG7wB5C9Y `ok`


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
