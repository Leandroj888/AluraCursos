<?php

namespace Alura\DesignPattern\EstadoOrcamento;

use Alura\DesignPattern\Orcamento;

class Finalizado extends EstadoOrcamento
{
    public function calculaDescontoExtra(Orcamento $orcamento): float
    {
        throw new \DomainException('Orçamentos Finalizado não pode receber desconto');
    }

}
