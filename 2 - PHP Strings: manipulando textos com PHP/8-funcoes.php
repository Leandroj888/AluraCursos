<?php

//subrotina - não retorna valor
function exibeMensagem(string $mensagem): void
{
    echo $mensagem . PHP_EOL;
}

//função - retorna valor
function sacar(array $conta, float $valor): array
{
    if ($valor < 0){
        exibeMensagem("Saques precisam ser positivo");
    } elseif($valor > $conta["saldo"]){
        exibeMensagem("Você não pode sacar esse valor");
    } else {
        $conta["saldo"] -= $valor;
    }
    return $conta;
}

function depositar(array $conta, float $valor): array
{
    if ($valor < 0){
        exibeMensagem("Depósitos precisam ser positivo");
    } else {
        $conta["saldo"] += $valor;
    }
    return $conta;
}

// & usa o ponteiro de memória
function titularMaiusculas(array &$conta): void
{
    $conta["titular"] = mb_strtoupper($conta["titular"]);
}


function exibeConta(array $conta): void
{
    ["titular" => $titular, "saldo" => $saldo] = $conta;
    echo "<li>Titular: $titular. Saldo: $saldo</li>";
}
