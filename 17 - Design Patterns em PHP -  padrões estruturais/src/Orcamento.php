<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\EstadosOrcamento\EmAprovacao;
use Alura\DesignPattern\EstadosOrcamento\EstadoOrcamento;

class Orcamento implements Orcavel
{
    //public int $quantidadeItens;
    //public float $valor;
    public array $itens;
    public EstadoOrcamento $estadoAtual;

    public function __construct()
    {
        $this->estadoAtual = new EmAprovacao();
        $this->itens = [];
    }

    public function aplicaDescontoExtra()
    {
        $this->valor -= $this->estadoAtual->calculaDescontoExtra($this);
    }

    public function aprova()
    {
        $this->estadoAtual->aprova($this);
    }

    public function reprova()
    {
        $this->estadoAtual->reprova($this);
    }

    public function finaliza()
    {
        $this->estadoAtual->finaliza($this);
    }
    
    public function addItem(Orcavel $item)
    {
        $this->itens[] = $item;
    }
    
    public function valor(): float
    {
        /*
        $count = 0;
        foreach ($this->itens as $item){
            $count += $item;
        }
        return $count;
        */ 
        return \array_reduce(
            $this->itens, 
            fn (float $valorAcumulado, Orcavel $item) => $valorAcumulado + $item->valor(), 
            0
        );
    }
}
