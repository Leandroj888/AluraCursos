<?php

namespace Alura\Banco\Modelo\Conta;

class ContaCorrente extends Conta {
    protected function percentualTarifa(): float
    {
        return 0.05;
    }

    public function transferir(float $valor, Conta $destino): void
    {
        $this->sacar($valor);
        $destino->depositar($valor);
    }
}