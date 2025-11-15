<?php

namespace Alura\DesignPattern\Log;

interface LogWriter
{
    public function escreve(string $mensagemFormatada): void;
}
