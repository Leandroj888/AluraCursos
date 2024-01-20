<?php

namespace Alura\DesignPattern\Log;

abstract class LogManager
{
    public function log(string $severidade, string $mensagem): void
    {
        $logWrite = $this->criarLogWrite();
        $dataHoje = date('d/m/Y');
        $mensagemFormatada = "[$dataHoje][$severidade]: $mensagem";
        $logWrite->escreve($mensagemFormatada);
    }
    
    abstract public function criarLogWrite(): LogWriter;
}
