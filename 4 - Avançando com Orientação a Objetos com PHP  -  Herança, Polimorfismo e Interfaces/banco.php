<?php

require_once("autoload.php");

use Alura\Banco\Modelo\Conta\Conta;
use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;


$endereco = new Endereco('Petrópolis','um Bairro','minha rua','71b');
$vinicius = new Titular(new Cpf('721.872.330-65'),'Vinícius',$endereco);
$primeiraConta = new Conta($vinicius);

$primeiraConta->depositar(500);
$primeiraConta->sacar(300);
//$primeiraConta->defineCpfTitular('123.456.789-10');

//echo $primeiraConta->recuperaCpfTitular() . PHP_EOL;
//echo $primeiraConta->recuperaNomeTitular() . PHP_EOL;
echo $primeiraConta->titular->cpf->cpf . PHP_EOL;
echo $primeiraConta->titular->recuperaNome() . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;

$patricia = new Titular(new Cpf('782.889.360-40'),'Patricia',$endereco);
$primeiraConta = new Conta($patricia);

echo $primeiraConta->titular->cpf->cpf . PHP_EOL;
echo $primeiraConta->titular->recuperaNome() . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;
$outro = new Endereco('Petrópolis','outro Bairro','outra rua','1d');
$luzia = new Titular(new Cpf('008.367.680-51'),'Luzia',$outro);
$segundaConta = new Conta($luzia);

echo $segundaConta->titular->cpf->cpf . PHP_EOL;
echo $segundaConta->titular->recuperaNome() . PHP_EOL;
echo $segundaConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;

echo "Total de Contas Cadastradas: " . Conta::recuperaNumeroDeContas() . PHP_EOL;

