<?php

$contaCorrentes = [
    1234567890 => [
        "titular" => "Viní",
        "saldo" => 1000
    ],
    2234569998 => [
        "titular" => "Maria",
        "saldo" => 10000
    ],
    9999567899 => [
        "titular" => "Albert",
        "saldo" => 300
    ]
];

$contaCorrentes[7888567890] = [
        "titular" => "Ana",
        "saldo" => 1000
];

foreach ($contaCorrentes as $cpf => $conta) {
    echo "CPF $cpf | Titular " . $conta["titular"] . "\t| Saldo "  . $conta["saldo"] .  PHP_EOL;
}


$idadeList = [21, 23, 19, 25, 30, 41, 18];

//$idadeList[count($idadeList)] = 15;
$idadeList[] = 15;
//array_push($idadeList,27);

foreach ($idadeList as $idade) {
    echo "Idade $idade" .  PHP_EOL;
}