<?php

namespace Alura\DesignPattern\Relatorio;

use Alura\DesignPattern\Orcamento;
use ZipArchive;

class OrcamentoZip
{
    public function exportar(Orcamento $orcamento)
    {
        $caminhoArquivo = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'orcamento.zip';
        $zip = new ZipArchive();
        $zip->open($caminhoArquivo, ZipArchive::CREATE);
        $zip->addFromString('orcamento.serial', serialize($orcamento));
        $zip->close();        
    }
}
