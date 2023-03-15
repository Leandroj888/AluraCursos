<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\Descontos\DescontoMaisDe500Reais;
use Alura\DesignPattern\Descontos\DescontoMaisDe5Itens;
use Alura\DesignPattern\Descontos\SemDesconto;

class CalculadoraDeDesconto
{
    public function calculaDescontos(Orcamento $orcamento): float
    {
        /*
        if ($orcamento->quantidadeItens > 5) {
            return $orcamento->valor * 0.1;
        }
        if ($orcamento->valor > 500) {
            return $orcamento->valor * 0.05;
        }
        return 0;
        */
        
        /*
        $desconto5Itens = new DescontoMaisDe5Itens();
        $desconto = $desconto5Itens->calculaDesconto($orcamento);
        if($desconto === 0) {
            $desconto500Reais = new DescontoMaisDe500Reais();
            $desconto = $desconto500Reais->calculaDesconto($orcamento);            
        }
        return $desconto;
        */
        
        $cadeiaDeDescontos = new DescontoMaisDe5Itens(new DescontoMaisDe500Reais(new SemDesconto()));
        return $cadeiaDeDescontos->calculaDesconto($orcamento);
    }
}
