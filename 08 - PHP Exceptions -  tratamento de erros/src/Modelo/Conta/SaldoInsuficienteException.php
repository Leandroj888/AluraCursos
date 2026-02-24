<?php

namespace Alura\Banco\Modelo\Conta;

use DomainException;
use Exception;

class SaldoInsuficienteException extends DomainException 
{
    public function __construct(float $valorSaque, float $saldoAtual)
    {
        $message = "Você tentou sacar $valorSaque, mas tem apenas $saldoAtual em conta.";
        parent::__construct($message);
    }
}