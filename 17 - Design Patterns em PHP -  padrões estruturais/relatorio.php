<?php

use Alura\DesignPattern\{Orcamento, Pedido};
use Alura\DesignPattern\Relatorio\{OrcamentoExportado, PedidoExportado, ArquivoXml, ArquivoZip};

require 'vendor/autoload.php';

$orcamento = new Orcamento();
$orcamento->valor = 500;
$orcamento->quantidadeItens = 7;

/*
$orcamentoExportado = new OrcamentoExportado($orcamento);
//$orcamentoExportadoXml = new ArquivoXml("orcamento");
$orcamentoExportadoXml = new ArquivoZip("orcamento.array");
echo $orcamentoExportadoXml->salvar($orcamentoExportado);
*/

$pedido = new Pedido();
$pedido->dataFinalizacao = new DateTimeImmutable();
$pedido->nomeCliente = 'Leandro';
$pedido->orcamento = $orcamento;


$pedidoExportado = new PedidoExportado($pedido);
$pedidoExportadoXml = new ArquivoXml("pedido");
//$pedidoExportadoXml = new ArquivoZip("pedido.array");
echo $pedidoExportadoXml->salvar($pedidoExportado);
