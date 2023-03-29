<?php

namespace Alura\DesignPattern\Relatorio;

use Alura\DesignPattern\Orcamento;
use SimpleXMLElement;

class OrcamentoXml
{
    public function export(Orcamento $orcamento): string
    {
        $elemnentoOrcamento = new SimpleXMLElement('<orcamento/>');
        $elemnentoOrcamento->addChild('valor', $orcamento->valor);
        $elemnentoOrcamento->addChild('quantidadeItens', $orcamento->quantidadeItens);
        
        return $elemnentoOrcamento->asXML();
    }

}
