<?php

namespace Alura\DesignPattern\Descontos;

use Alura\DesignPattern\Orcamento;

abstract class Desconto
{
    public function __construct(
        protected Desconto $proximoDesconto
    ) {
        
    }
    abstract public function calculaDesconto(Orcamento $orcamento): float;
    
    
}
