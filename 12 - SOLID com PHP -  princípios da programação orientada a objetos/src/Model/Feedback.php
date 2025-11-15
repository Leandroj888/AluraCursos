<?php

namespace Alura\Solid\Model;

class Feedback
{
    public function __construct(
        private int $nota, 
        private ?string $depoimento
    ){
        if ($nota < 9 && empty($depoimento)) {
            throw new \DomainException('Depoimento obrigatório');
        }
        
    }

    public function recuperarNota(): int
    {
        return $this->nota;
    }

    public function recuperarDepoimento(): ?string
    {
        return $this->depoimento;
    }
}
