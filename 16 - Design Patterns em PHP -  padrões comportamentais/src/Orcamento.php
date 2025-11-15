<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\EstadoOrcamento\EmAprovacao;
use Alura\DesignPattern\EstadoOrcamento\EstadoOrcamento;

class Orcamento 
{
    public int $quantidadeItens;
    public float $valor;
    public EstadoOrcamento $estadoAtual;
    
    public function __construct()
    {
        $this->estadoAtual = new EmAprovacao();
    }
    
    public function aplicaDescontoExtra()
    {
        //$this->valor -= $this->calculaDescontoExtra($this);
        $this->valor -= $this->estadoAtual->calculaDescontoExtra($this);
    }
    /*
    public function calculaDescontoExtra()
    {
        if ($this->estadoAtual == 'EM_APROVACAO') {
            return $this->valor * 0.05;
        }
        if ($this->estadoAtual == 'APROVADO') {
            return $this->valor * 0.03;
        }
        throw new \DomainException('Orçamentos Reprovados e finalizados não pode receber desconto');
    }
    */
    
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
}