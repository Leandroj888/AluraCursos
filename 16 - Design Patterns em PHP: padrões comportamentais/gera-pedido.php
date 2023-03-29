<?php

use Alura\DesignPattern\AcoesAoGerarPedido\CriarPedidoNoBanco;
use Alura\DesignPattern\AcoesAoGerarPedido\EnviarPedidoViaEmail;
use Alura\DesignPattern\AcoesAoGerarPedido\GerarLogDoPedido;
use Alura\DesignPattern\GerarPedido;
use Alura\DesignPattern\GerarPedidoHandler;
use Alura\DesignPattern\Orcamento;
use Alura\DesignPattern\Pedido;

require 'vendor/autoload.php';

//php gera-pedido.php 1200.5 7 "Leandro"

$valorOrcamento = $argv[1];
$numeroDeItens = $argv[2];
$nomeCliente = $argv[3];

$gerarPedido = new GerarPedido(
    $valorOrcamento,
    $numeroDeItens,
    $nomeCliente  
);
//$gerarPedido->execute();
$gerarPedidoHandler = new GerarPedidoHandler();
/*
$gerarPedidoHandler->adicionarAcaoAoGerarPedido(new CriarPedidoNoBanco());
$gerarPedidoHandler->adicionarAcaoAoGerarPedido(new EnviarPedidoViaEmail());
$gerarPedidoHandler->adicionarAcaoAoGerarPedido(new GerarLogDoPedido());
*/
$gerarPedidoHandler->attach(new CriarPedidoNoBanco());
$gerarPedidoHandler->attach(new EnviarPedidoViaEmail());
$gerarPedidoHandler->attach(new GerarLogDoPedido());
$gerarPedidoHandler->execute($gerarPedido);
/*
$orcamento = new Orcamento();
$orcamento->valor = $valorOrcamento;
$orcamento->quantidadeItens = $numeroDeItens;

$pedido = new Pedido();
$pedido->dataFinalizacao = new \DateTimeImmutable();
$pedido->nomeCliente = $nomeCliente;
$pedido->orcamento = $orcamento;


echo "Cria pedido no banco de dados" . PHP_EOL;
echo "Envia e-mail para cliente" . PHP_EOL;
*/

