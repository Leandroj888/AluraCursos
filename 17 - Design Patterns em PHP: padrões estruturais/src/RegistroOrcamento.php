<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\EstadoOrcamento\Finalizado;
use Alura\DesignPattern\Http\HttpAdapter;
use DomainException;
use PhpParser\Node\Expr\Instanceof_;

class RegistroOrcamento
{
    public function __construct(
        private HttpAdapter $http
    ) {
    }

    public function registrar(Orcamento $orcamento): void
    {
        //chamar uma api de registro
        if (!$orcamento->estadoAtual instanceof Finalizado) {
            throw new DomainException('Apenas orçamentos finalizados podem ser registrados pela API');
        }
        
        $this->http->post('http://api.registrar.orcamento', [
            'valor' => $orcamento->valor,
            'quantidadeItens' => $orcamento->quantidadeItens,
        ]);
        
        //enviar os dados do orçamento
    }

}
