<?php

namespace Alura\DesignPattern\Log;

class StdOutLogWriter implements LogWriter
{
    public function escreve(string $mensagemFormatada): void
    {
        echo $mensagemFormatada;
    }

}
