<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\AcoesAoGerarPedido\AcaoAposGerarPedido;
use Alura\DesignPattern\AcoesAoGerarPedido\CriarPedidoNoBanco;
use Alura\DesignPattern\AcoesAoGerarPedido\EnviarPedidoViaEmail;
use Alura\DesignPattern\AcoesAoGerarPedido\GerarLogDoPedido;
use SplObserver;
use SplSubject;

//class GerarPedidoHandler implements SplSubject
class GerarPedidoHandler
{
    /**
     * @var AcaoAposGerarPedido[] $acoesAposGerarPedido
     */
    private array $acoesAposGerarPedido;
    public Pedido $pedido;
    
    public function __construct(
        //private PedidoRepository $pedidoRepository,
        //private MailService $mailService
    ) {
    }
    
    public function adicionarAcaoAoGerarPedido(AcaoAposGerarPedido $observer)
    //public function attach(SplObserver $observer): void
    {
        $this->acoesAposGerarPedido[] = $observer;
    }
    
    public function detach(SplObserver $observer): void
    {
        
    }
    
    public function notify(): void
    {
        /*
        foreach ($this->acoesAposGerarPedido as $acao) {
            $acao->update($this);
        }
        */
        foreach ($this->acoesAposGerarPedido as $acao) {
            $acao->executaAcao($this->pedido);
        }
    }
    
    
    public function execute(GerarPedido $gerarPedido): void
    {
        $orcamento = new Orcamento();
        $orcamento->valor = $gerarPedido->getValorOrcamento();
        $orcamento->quantidadeItens = $gerarPedido->getNumeroDeItens();
        
        $pedido = new Pedido();
        $pedido->dataFinalizacao = new \DateTimeImmutable();
        $pedido->nomeCliente = $gerarPedido->getNomeCliente();
        $pedido->orcamento = $orcamento; 
        
        $this->pedido = $pedido;
        $this->notify();
             
        /*
        // Pedido Repository
        //echo "Cria pedido no banco de dados" . PHP_EOL;
        $pedidoRepository = new CriarPedidoNoBanco();
        
        // Mail Service
        //echo "Envia e-mail para cliente" . PHP_EOL;
        $emailPedido = new EnviarPedidoViaEmail();
        
        // Gerador log
        //echo "Gerador de Log" . PHP_EOL;
        $logPedido = new GerarLogDoPedido();
        
        $pedidoRepository->executaAcao($pedido);
        $emailPedido->executaAcao($pedido);
        $logPedido->executaAcao($pedido);
        */
        
        /*
        foreach ($this->acoesAposGerarPedido as $acao) {
            $acao->executaAcao($pedido);
        }
        */
    }

}
