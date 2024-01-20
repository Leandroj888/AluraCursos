<?php

namespace Alura\DesignPattern\Log;

class StdOutLogManager extends LogManager
{
    public function criarLogWrite(): LogWriter
    {
        return new StdOutLogWriter();
    }
}
