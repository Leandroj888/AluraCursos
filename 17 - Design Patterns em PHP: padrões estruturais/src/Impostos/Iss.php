<?php

namespace Alura\DesignPattern\Impostos;

use Alura\DesignPattern\Orcamento;
/*
class Iss implements Imposto
{
    public function calculaImposto(Orcamento $orcamento): float
    {
        return $orcamento->valor * 0.06;
    }
}
*/
class Iss extends Imposto
{
    public function realizaCalculoEspecifico(Orcamento $orcamento): float
    {
        return $orcamento->valor * 0.06;
    }
}
