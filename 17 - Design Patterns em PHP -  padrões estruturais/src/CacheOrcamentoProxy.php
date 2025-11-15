<?php

namespace Alura\DesignPattern;

use DomainException;

class CacheOrcamentoProxy extends Orcamento
{
    private float $valorCache = 0;
    
    public function __construct(
        private Orcamento $orcamento
    ) {   
    }
    
    public function valor(): float
    {
        if ($this->valorCache == 0) {
            $this->valorCache = $this->orcamento->valor();
        }
        return $this->valorCache;
    }
    
    public function addItem(Orcavel $item)
    {
        throw new \DomainException(
            'Não é possível adicionar item');
    }
}
