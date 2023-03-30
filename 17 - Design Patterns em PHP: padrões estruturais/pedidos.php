<?php

use Alura\DesignPattern\DadosExtrinsecosPedidos;
use Alura\DesignPattern\Orcamento;
use Alura\DesignPattern\Pedido;

require_once 'vendor/autoload.php';

$pedidos = [];
$hoje =  new DateTimeImmutable();
$dados = new DadosExtrinsecosPedidos("Leandro", $hoje);

for ($i = 0; $i < 10000; $i++) {
    $pedido = new Pedido();
    //$pedido->dataFinalizacao = new DateTimeImmutable();
    //$pedido->dataFinalizacao = $hoje;
    //$pedido->nomeCliente = md5((string) rand(1,100000));
    $pedido->dados = $dados;
    $pedido->orcamento = new Orcamento();
    
    $pedidos[] = $pedido;
}

echo memory_get_peak_usage() / 1024 / 1024;