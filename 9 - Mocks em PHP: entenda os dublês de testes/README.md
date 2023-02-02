# Links
https://martinfowler.com/articles/mocksArentStubs.html `ok`

# Executar Testes
vendor/bin/phpunit

# Testar se um metodo e chamado e quantas vezes

```php
$mock->expects($this->exactly(2))->method('nome_metodo');


$mock->expects($this->once())->method('nome_metodo')->with($parametro1, $parametro2);


$mock->expects($this->exactly(2))
    ->method('nome_metodo')
    ->withConsecutive(
        [$parametro11, $parametro21],
        [$parametro21, $parametro22],
    );
```

# Passar argumentos para a class mock

```php
$mock = $this->getMockBuilder(Class::class)
            ->setConstructorArgs([$par1,$par2])
            ->getMock();
```


# Desabilitar construtor

```php
$mock = $this->getMockBuilder(Class::class)
            ->disableOriginalConstructor()
            ->getMock();
```