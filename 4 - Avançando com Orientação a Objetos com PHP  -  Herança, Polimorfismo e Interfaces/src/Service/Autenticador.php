<?php

namespace Alura\Banco\Service;

use Alura\Banco\Modelo\Autenticavel;

class Autenticador
{
    public function tentaLogin(Autenticavel $autenticavel, string $senha): bool
    {
        if ($autenticavel->podeAutenticar($senha)) {
            echo "Usuário Logado" . PHP_EOL;
            return true;
        }

        echo "Senha Incorreta" . PHP_EOL;
        return false;
    }
}