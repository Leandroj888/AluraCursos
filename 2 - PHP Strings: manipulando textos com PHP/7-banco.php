<?php

$contaCorrentes = [
    "123.456.789-10" => [
        "titular" => "Viní",
        "saldo" => 500
    ],
    "123.456.789-11" => [
        "titular" => "Maria",
        "saldo" => 10000
    ],
    "123.456.789-12" => [
        "titular" => "Albert",
        "saldo" => 300
    ]
];

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



$contaCorrentes["123.456.789-11"] = sacar($contaCorrentes["123.456.789-11"], 500);
$contaCorrentes["123.456.789-12"] = sacar($contaCorrentes["123.456.789-12"], 200);
$contaCorrentes["123.456.789-10"] = depositar($contaCorrentes["123.456.789-10"], 500);

//https://www.php.net/manual/en/language.types.string.php
foreach ($contaCorrentes as $cpf => $conta) {
    //exibeMensagem("CPF $cpf | Titular " . $conta["titular"] . "\t| Saldo "  . $conta["saldo"]);

    //exibeMensagem("CPF $cpf | Titular $conta[titular] \t| Saldo $conta[saldo]"); //forma simples

    exibeMensagem("CPF $cpf | Titular {$conta["titular"]} \t| Saldo {$conta["saldo"]}"); //forma complexa
}