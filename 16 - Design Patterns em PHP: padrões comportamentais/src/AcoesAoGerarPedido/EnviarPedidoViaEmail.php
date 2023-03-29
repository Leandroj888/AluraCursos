<?php

namespace Alura\DesignPattern\AcoesAoGerarPedido;

use Alura\DesignPattern\Pedido;
use SplObserver;
use SplSubject;


class EnviarPedidoViaEmail implements AcaoAposGerarPedido
{
    public function executaAcao(Pedido $pedido): void
    {
        echo "Envia e-mail para cliente" . PHP_EOL;
    }


}
/*
class EnviarPedidoViaEmail implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        echo "Envia e-mail para cliente" . PHP_EOL;
    }

}
*/
