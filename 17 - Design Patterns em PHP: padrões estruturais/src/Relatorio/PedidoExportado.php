<?php

namespace Alura\DesignPattern\Relatorio;

use Alura\DesignPattern\Pedido;

class PedidoExportado implements ConteudoExportado
{
    public function __construct(
        private Pedido $pedido
    ) { 
    }
    public function conteudo(): array {
        return [
            'data_finalizacao' => $this->pedido->dataFinalizacao->format('d/m/Y'),
            'nome_cliente' => $this->pedido->nomeCliente,
        ];
    }
}
