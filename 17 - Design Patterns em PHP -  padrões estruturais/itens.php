<?php

use Alura\DesignPattern\CacheOrcamentoProxy;
use Alura\DesignPattern\ItemOrcamento;
use Alura\DesignPattern\Orcamento;
use PhpParser\Node\Expr\New_;

require_once 'vendor/autoload.php';

$orcamento = new Orcamento();

$item1 = new ItemOrcamento();
$item1->valor = 300;

$item2 = new ItemOrcamento();
$item2->valor = 500;

$orcamento->addItem($item1);
$orcamento->addItem($item2);

$orcamentoAntigo = new Orcamento(); 
$item3 = new ItemOrcamento();
$item3->valor = 1000;
$orcamentoAntigo->addItem($item3);

$orcamentoMaisAntigo = new Orcamento(); 
$item4 = new ItemOrcamento();
$item4->valor = 1000;
$orcamentoMaisAntigo->addItem($item4);
$orcamentoAntigo->addItem($orcamentoMaisAntigo);

$orcamento->addItem($orcamentoAntigo);

$proxyCache = new CacheOrcamentoProxy($orcamento);

echo $proxyCache->valor() . PHP_EOL;
echo $proxyCache->valor() . PHP_EOL;