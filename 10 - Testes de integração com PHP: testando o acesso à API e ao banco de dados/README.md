# Links
https://martinfowler.com/articles/mocksArentStubs.html `ok`

# Instalar Testes
```bash
composer install
```

# Executar Servidor
```bash
php -S localhost:8081
```

# Executar Testes
```bash
vendor/bin/phpunit
```
# Executar Testes de uma pasta
```bash
vendor/bin/phpunit tests/Integration
```

# Executar Testes de uma suite
Configurar antes em phpunit.xml
```xml
    <testsuites>
        <testsuite name="unit">
            <directory>tests/Unit</directory>
        </testsuite>

        <testsuite name="integration">
            <directory>tests/Integration</directory>
        </testsuite>
    </testsuites>
```

Depois executar o comando
```bash
vendor/bin/phpunit --testsuite=integration
```
