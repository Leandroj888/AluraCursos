<?php

namespace Alura\DesignPattern\Log;

class FileLogManager extends LogManager
{
    public function __construct(
        private string $caminhoArquivo
    ) {}

    public function criarLogWrite(): LogWriter
    {
        return new FileLogWriter($this->caminhoArquivo);
    }
}
