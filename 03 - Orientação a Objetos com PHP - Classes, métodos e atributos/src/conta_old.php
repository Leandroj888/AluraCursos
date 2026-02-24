<?php

//$conta = criarConta('123.456.789-10', 'Vinicius Dias', 500);
//$conta['123.456-789-10']['saldo'] -= 1000;

function criarConta(string $cpf, string $nomeTitular, float $saldo): array
{

    return [
        $cpf => [
            'titular' => $nomeTitular,
            'saldo' => $saldo
        ]
    ];
}