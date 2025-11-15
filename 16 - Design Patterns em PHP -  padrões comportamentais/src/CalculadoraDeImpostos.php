<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\Impostos\Imposto;

class CalculadoraDeImpostos
{
    public function calcula(Orcamento $orcamento, Imposto $imposto): float
    {
        /*
        switch ($nomeImposto) {
            case "ICMS":
                return $orcamento->valor * 0.1;
            case "ISS":
                return $orcamento->valor * 0.06;
                
        }
        */
        return $imposto->calculaImposto($orcamento);
    }
}
