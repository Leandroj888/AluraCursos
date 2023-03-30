<?php

namespace Alura\DesignPattern;

class DadosExtrinsecosPedidos
{
    public function __construct(
        private string $nomeCliente,
        private \DateTimeInterface $dataFinalizacao
    ) {   
    }
    
    public function getNomeCliente(): string
    {
        return $this->nomeCliente;
    }
    
    public function getDataFinalizacao(): \DateTimeInterface
    {
        return $this->dataFinalizacao;
    }
}
