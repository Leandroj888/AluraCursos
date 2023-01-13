<?php

require_once("autoload.php");

use Alura\Banco\Modelo\Conta\{ContaPoupanca, ContaCorrente, Conta, Titular};
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;

$endereco = new Endereco('Petrópolis','um Bairro','minha rua','71b');
$vinicius = new Titular(new Cpf('721.872.330-65'),'Vinícius',$endereco);
$primeiraConta = new ContaCorrente($vinicius);

$primeiraConta->depositar(500);
$primeiraConta->sacar(100);

echo $primeiraConta->titular->cpf->cpf . PHP_EOL;
echo $primeiraConta->titular->recuperaNome() . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;