<?php

use Alura\DesignPattern\Orcamento;
use Alura\DesignPattern\Pedido\CriadorDePedido;
use Alura\DesignPattern\Pedido\Pedido;
use Alura\DesignPattern\Pedido\TemplatePedido;

require 'vendor/autoload.php';

$pedidos = [];
//$template = new TemplatePedido(md5('a'), new \DateTimeImmutable());
$criadorDePedido = new CriadorDePedido();

for ($i = 0; $i < 10000; $i++) {
    //$pedido = new Pedido();
    //$pedido->template = $template;
    $orcamento = new Orcamento();
    $pedido = $criadorDePedido ->criaPedido(md5('a'), date('Y-m-d'), $orcamento);

    $pedidos[] = $pedido;
}

echo memory_get_peak_usage();
