<?php

namespace Alura\DesignPattern\Relatorio;

use SimpleXMLElement;

class ArquivoXml implements ArquivoExportado
{
    public function __construct(
        private string $nomeElementoPai
    ) {
    }

    public function salvar(ConteudoExportado $conteudo): string
    {        
        $elemnentoOrcamento = new SimpleXMLElement("<{$this->nomeElementoPai}/>");
        foreach($conteudo->conteudo() as $key => $value) {
            $elemnentoOrcamento->addChild($key, $value);
        }
        
        $caminho = tempnam(sys_get_temp_dir(), 'xml');
        $elemnentoOrcamento->asXML($caminho);
        return $caminho ;
    }
}
