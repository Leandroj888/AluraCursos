<?php

require_once("autoload.php");

use Alura\Banco\Modelo\Conta\{ContaPoupanca, ContaCorrente, Conta, SaldoInsuficienteException, Titular};
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;

$endereco = new Endereco('Petrópolis','um Bairro','minha rua','71b');
$vinicius = new Titular(new Cpf('721.872.330-65'),'Vinícius',$endereco);
$primeiraConta = new ContaCorrente($vinicius);

try {
    $primeiraConta->depositar(-500);
} catch (InvalidArgumentException $exception) {   
    echo "Depósitos precisam ser positivo XX";
}

try {
    $primeiraConta->sacar(800);
} catch (SaldoInsuficienteException $exception) {
    echo PHP_EOL . "Você, não têm saldo para realizar este saque." . PHP_EOL;
    echo $exception->getMessage() . PHP_EOL;
}
echo $primeiraConta->titular->cpf->cpf . PHP_EOL;
echo $primeiraConta->titular->recuperaNome() . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;