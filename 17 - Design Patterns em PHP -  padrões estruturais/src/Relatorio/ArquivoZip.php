<?php

namespace Alura\DesignPattern\Relatorio;

use ZipArchive;

class ArquivoZip implements ArquivoExportado
{
    public function __construct(
        private string $nomeArquivoInterno
    ) {
    }

    public function salvar(ConteudoExportado $conteudo): string
    { 
        $caminhoArquivo = tempnam(sys_get_temp_dir(), 'zip');
        $zip = new ZipArchive();
        $zip->open($caminhoArquivo, ZipArchive::CREATE);
        $zip->addFromString($this->nomeArquivoInterno, serialize($conteudo->conteudo()));
        $zip->close(); 
        
        return $caminhoArquivo;
    }
}
