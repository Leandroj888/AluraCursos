<?php

namespace Alura\DesignPattern;

class GerarPedido //implements Comando
{
    public function __construct(
        private float $valorOrcamento,
        private int $numeroDeItens,
        private string $nomeCliente,
    ) {
    }
    
    /*
    public function execute(): void
    {
        $orcamento = new Orcamento();
        $orcamento->valor = $this->getValorOrcamento();
        $orcamento->quantidadeItens = $this->getNumeroDeItens();
        
        $pedido = new Pedido();
        $pedido->dataFinalizacao = new \DateTimeImmutable();
        $pedido->nomeCliente = $this->getNomeCliente();
        $pedido->orcamento = $orcamento; 
               
        // Pedido Repository
        echo "Cria pedido no banco de dados" . PHP_EOL;
        
        // Mail Service
        echo "Envia e-mail para cliente" . PHP_EOL;
    }
    */

    public function getValorOrcamento(): float
    {
            return $this->valorOrcamento;
    }

    public function setValorOrcamento(float $valorOrcamento)
    {
            $this->valorOrcamento = $valorOrcamento;

            return $this;
    }

    public function getNumeroDeItens(): int
    {
            return $this->numeroDeItens;
    }

    public function setNumeroDeItens(int $numeroDeItens)
    {
            $this->numeroDeItens = $numeroDeItens;

            return $this;
    }

    public function getNomeCliente(): string
    {
            return $this->nomeCliente;
    }

    public function setNomeCliente(string $nomeCliente)
    {
            $this->nomeCliente = $nomeCliente;

            return $this;
    }
}
