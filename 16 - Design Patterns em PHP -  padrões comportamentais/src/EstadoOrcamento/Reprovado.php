<?php

namespace Alura\DesignPattern\EstadoOrcamento;

use Alura\DesignPattern\Orcamento;

class Reprovado extends EstadoOrcamento
{
    public function calculaDescontoExtra(Orcamento $orcamento): float
    {
        throw new \DomainException('Orçamentos Reprovados não pode receber desconto');
    }
    
    public function finaliza(Orcamento $orcamento)
    {
        $orcamento->estadoAtual = new Finalizado();
    }
}
