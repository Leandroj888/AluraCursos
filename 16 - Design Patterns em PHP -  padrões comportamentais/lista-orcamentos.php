<?php

use Alura\DesignPattern\ListaDeOrcamentos;
use Alura\DesignPattern\Orcamento;
use Alura\DesignPattern\Pedido;

require 'vendor/autoload.php';

//$listaOrcametos = [];
$listaOrcametos = new ListaDeOrcamentos();

$orcamento1 = new Orcamento();
$orcamento1->quantidadeItens = 7;
$orcamento1->aprova();
$orcamento1->valor = 1500.75;

$orcamento2 = new Orcamento();
$orcamento2->quantidadeItens = 3;
$orcamento2->reprova();
$orcamento2->valor = 150;

$orcamento3 = new Orcamento();
$orcamento3->quantidadeItens = 5;
$orcamento3->aprova();
$orcamento3->finaliza();
$orcamento3->valor = 1350;

/*
$listaOrcametos =[
    $orcamento1,
    $orcamento2,
    $orcamento3,
];
*/
$listaOrcametos->addOrcamento($orcamento1);
$listaOrcametos->addOrcamento($orcamento2);
$listaOrcametos->addOrcamento($orcamento3);

foreach ($listaOrcametos as $orcamento) {
    echo "Valor: " . $orcamento->valor . PHP_EOL;
    echo "Estado: " . get_class($orcamento->estadoAtual) . PHP_EOL;
    echo "Qtd, Itens: " . $orcamento->quantidadeItens . PHP_EOL;
    
    echo PHP_EOL;
}


foreach ($listaOrcametos->orcamentosFinalizados() as $orcamento) {
    echo "Valor: " . $orcamento->valor . PHP_EOL;
    echo "Estado: " . get_class($orcamento->estadoAtual) . PHP_EOL;
    echo "Qtd, Itens: " . $orcamento->quantidadeItens . PHP_EOL;
    
    echo PHP_EOL;
}