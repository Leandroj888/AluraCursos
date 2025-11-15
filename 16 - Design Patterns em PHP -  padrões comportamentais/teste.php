
<?php

use Alura\DesignPattern\CalculadoraDeDesconto;
use Alura\DesignPattern\CalculadoraDeImpostos;
use Alura\DesignPattern\Impostos\Icms;
use Alura\DesignPattern\Impostos\Icpp;
use Alura\DesignPattern\Impostos\Ikcv;
use Alura\DesignPattern\Impostos\Iss;
use Alura\DesignPattern\Orcamento;

require 'vendor/autoload.php';

$calculadora = new CalculadoraDeImpostos();

$orcamento = new Orcamento();
$orcamento->valor = 100;

//echo $calculadora->calcula($orcamento, "ICMS") . PHP_EOL;
//echo $calculadora->calcula($orcamento, "ISS") . PHP_EOL;

/*
echo $calculadora->calcula($orcamento, new Icms()) . PHP_EOL;
echo $calculadora->calcula($orcamento, new Iss()) . PHP_EOL;

echo "========================" . PHP_EOL;

$calculadora = new CalculadoraDeDesconto();
$orcamento->quantidadeItens = 2;
echo  "2 Itens e 100 reais: " . $calculadora->calculaDescontos($orcamento) . PHP_EOL;
$orcamento->quantidadeItens = 20;
echo  "20 Itens e 100 reais: " . $calculadora->calculaDescontos($orcamento) . PHP_EOL;
$orcamento->quantidadeItens = 2;
$orcamento->valor = 600;
echo  "2 Itens e 600 reais: " . $calculadora->calculaDescontos($orcamento) . PHP_EOL;
$orcamento->quantidadeItens = 20;
$orcamento->valor = 600;
echo "20 Itens e 600 reais: " . $calculadora->calculaDescontos($orcamento) . PHP_EOL;

echo "========================" . PHP_EOL;
*/

echo $calculadora->calcula($orcamento, new Icpp()) . PHP_EOL;
echo $calculadora->calcula($orcamento, new Ikcv()) . PHP_EOL;