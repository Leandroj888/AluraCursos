<?php

function funcao1()
{
    echo 'Entrei na função 1' . PHP_EOL;
    
    try {
        //$arrayFixo = new SplFixedArray(2);
        //$arrayFixo[3] = 'testes';
        funcao2();
    } 
    catch (RuntimeException | DivisionByZeroError $e) { //multicatch

        echo $e->getMessage() . PHP_EOL;
        echo $e->getLine() . PHP_EOL;
        echo $e->getFile() . PHP_EOL;
        echo $e->getTraceAsString() . PHP_EOL;
    }

    /*
    catch (RuntimeException) {
        echo "RuntimeException - Aconteceu um erro na função 2 mas acusou na funcao 1" . PHP_EOL;
    } catch (DivisionByZeroError) {
        echo "DivisionByZeroError - Aconteceu um erro na função 2 mas acusou na funcao 1" . PHP_EOL;
    }
    */
    //$divisao = intdiv(5 , 0);
    
    
    echo 'Saindo da função 1' . PHP_EOL;
}

function funcao2()
{
    echo 'Entrei na função 2' . PHP_EOL;
    $divisao = intdiv(5 , 0);
    $arrayFixo = new SplFixedArray(2);
    $arrayFixo[3] = 'testes';
    for ($i = 1; $i <= 5; $i++) {
        echo $i . PHP_EOL;
    }
    //var_dump(debug_backtrace());
    //print_r(debug_backtrace());
    echo 'Saindo da função 2' . PHP_EOL;
}

echo 'Iniciando o programa principal' . PHP_EOL;
funcao1();
echo 'Finalizando o programa principal' . PHP_EOL;


class Main {
    public function __construct()
    {
        echo 'Hello';
    }

    /**
     * Summary of teste
     * @param string $name
     * @return void
     */
    public function teste(string $name): void
    {
        
    }
}

(new Main())->teste();