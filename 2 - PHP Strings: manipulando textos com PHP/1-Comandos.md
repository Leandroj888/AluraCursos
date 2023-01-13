

# Aula 5


## mb_strtoupper

faz upper de characters complexos como acentuados.

:::tip
No PHP 8 já vém habilitado
:::


Localiza o local do php.ini
```bash
php -i | grep 'php.ini'
```

procure por `;extension=mbstring` e remova o `;`
procure por `;extension_dir = "./"` e remova o `;`


# Aula 6

## PHP microserver

```bash
php -S localhost:8080
```