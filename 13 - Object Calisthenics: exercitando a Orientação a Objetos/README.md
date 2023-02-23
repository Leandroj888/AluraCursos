# Links
https://cursos.alura.com.br/course/object-calisthenics-exercitando-orientacao-objetos/task/81978 `ok`
https://www.youtube.com/watch?v=6mfX6863SAk `ok`
http://wiki.c2.com/?LawOfDemeter `ok`

# Instalar ext-ds
Uma extensão que fornece estruturas de dados especializadas como alternativas eficientes ao array PHP
```bash
sudo apt install php-pear
sudo apt install php-dev
sudo pecl install ds
php -m
```
`Na lista deve ter PS`

Habilitar no php.ini a `extension=ds.so` no meu caso fica em `/etc/php/8.1/php.ini`

# Comandos
```bash
composer update
vendor/bin/phpunit

#php -S 0.0.0.0:8080 -t public
```

# Color PHPUNIT
phpunit.xml
``` xml
<phpunit
    colors="true">
</phpunit>
```

# Complexidade Ciclomática
Mais ifs e elses mais complexo é o método, mais é pior

# Regras
1. Não usar getter e setters
    1.1. Tell. Don't ask -> Não expor dados internos e sim funcionabilidades
2. Ter apenas 1 nível de indentação por método
3. Nunca use Else
    3.1. Early Return
    3.2. Fail Fast
4. Envolva seus tipos primitivos (parsimonia - caso eles tenham comportamento, email, telefone)
5. Coleção de primeira classe (Sempre que manipula a coleção ideal e extrair para classe especifica, ou para tipar um array)
6. Apenas 1 "ponto" por instrução  (Operador de acesso ->) Lei de Demeter -  não falar com estranhos
7. NUNCA abrevie (Nome muito grande / método fazendo muita coisa) (Acesso em muitos lugares)
8. Mantenha suas classes (Max 50 linhas) e pacotes pequenos (máx 10 classes)
9. Tenha no máximo 2 propriedades numa class (? porque)


Object Calisthenics are programming exercises, formalized as a set of 9 rules invented
by Jeff Bay in his book The Thought Works Anthology.