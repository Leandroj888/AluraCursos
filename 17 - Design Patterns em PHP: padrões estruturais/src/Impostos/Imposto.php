<?php

namespace Alura\DesignPattern\Impostos;

use Alura\DesignPattern\Orcamento;

abstract class Imposto
{
    public function __construct(
        private ?Imposto $outroImposto = null
    ) {  
    }

    abstract protected function realizaCalculoEspecifico(Orcamento $orcamento): float;
    
    public function calculaImposto(Orcamento $orcamento): float
    {
        return $this->realizaCalculoEspecifico($orcamento) + $this->realizaCalculoOutroImposto($orcamento);
    }
    
    private function realizaCalculoOutroImposto(Orcamento $orcamento): float
    {
        return empty($this->outroImposto) ? 0 : $this->outroImposto->calculaImposto($orcamento);
    }
}