<?php

namespace Alura\DesignPattern\Log;

class FileLogWriter implements LogWriter
{
    private $arquivo;
    
    public function __construct(string $caminhoArquivo)
    {
        $this->arquivo = fopen($caminhoArquivo, 'a+');
    }
    
    public function escreve(string $mensagemFormatada): void
    {
        fwrite($this->arquivo, $mensagemFormatada . PHP_EOL);
    }

    public function __destruct()
    {
        fclose($this->arquivo);
    }
}
