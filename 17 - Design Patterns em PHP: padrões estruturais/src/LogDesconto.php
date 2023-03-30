<?php

namespace Alura\DesignPattern;

class LogDesconto
{
    public function informar(float $descontoCalculado): void
    {
        echo "Salvando log de desconto: $descontoCalculado";
    }
    
    

}
