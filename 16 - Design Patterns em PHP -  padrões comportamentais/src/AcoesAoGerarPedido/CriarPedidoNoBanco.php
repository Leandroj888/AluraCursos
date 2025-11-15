<?php

namespace Alura\DesignPattern\AcoesAoGerarPedido;

use Alura\DesignPattern\Pedido;
use SplObserver;
use SplSubject;


class CriarPedidoNoBanco implements AcaoAposGerarPedido
{
    public function executaAcao(Pedido $pedido): void
    {
        echo "Cria pedido no banco de dados" . PHP_EOL;
    }

}
/*
class CriarPedidoNoBanco implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo "Cria pedido no banco de dados" . PHP_EOL;
    }

}
*/
