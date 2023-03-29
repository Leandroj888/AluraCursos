<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\EstadoOrcamento\Finalizado;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

class ListaDeOrcamentos implements IteratorAggregate
{
    private array $orcamentos = [];
    
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->orcamentos);
    }

    public function addOrcamento(Orcamento $orcamento)
    {
        $this->orcamentos[] = $orcamento;
    }
    /*
    public function orcamentos(): array
    {
        return $this->orcamentos;
    }
    */
    public function orcamentosFinalizados(): array
    {
        return array_filter(
            $this->orcamentos,
            fn (Orcamento $orcamento) => $orcamento->estadoAtual instanceof Finalizado
        );
    }
}
