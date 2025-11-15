<?php

namespace Alura\DesignPattern\AcoesAoGerarPedido;

use Alura\DesignPattern\Pedido;
use SplObserver;
use SplSubject;


class GerarLogDoPedido implements AcaoAposGerarPedido
{
    public function executaAcao(Pedido $pedido): void
    {
        echo "Gerador de Log" . PHP_EOL;
    }


}
/*
class GerarLogDoPedido implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo "Gerador de Log" . PHP_EOL;
    }

}
*/
