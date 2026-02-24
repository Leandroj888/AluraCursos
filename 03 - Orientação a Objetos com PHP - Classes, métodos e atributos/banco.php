<?php

require_once 'src/Conta.php';
require_once 'src/Titular.php';
require_once 'src/Cpf.php';

$vinicius = new Titular(new Cpf('721.872.330-65'),'Vinícius');
$primeiraConta = new Conta($vinicius);

$primeiraConta->depositar(500);
$primeiraConta->sacar(300);
//$primeiraConta->defineCpfTitular('123.456.789-10');

//echo $primeiraConta->recuperaCpfTitular() . PHP_EOL;
//echo $primeiraConta->recuperaNomeTitular() . PHP_EOL;
echo $primeiraConta->titular->cpfTitular->cpf . PHP_EOL;
echo $primeiraConta->titular->nomeTitular . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;

$patricia = new Titular(new Cpf('782.889.360-40'),'Patricia');
$primeiraConta = new Conta($patricia);

echo $primeiraConta->titular->cpfTitular->cpf . PHP_EOL;
echo $primeiraConta->titular->nomeTitular . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;
$luzia = new Titular(new Cpf('008.367.680-51'),'Luzia');
$segundaConta = new Conta($luzia);

echo $segundaConta->titular->cpfTitular->cpf . PHP_EOL;
echo $segundaConta->titular->nomeTitular . PHP_EOL;
echo $segundaConta->recuperaSaldo() . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;

echo "Total de Contas Cadastradas: " . Conta::recuperaNumeroDeContas() . PHP_EOL;

