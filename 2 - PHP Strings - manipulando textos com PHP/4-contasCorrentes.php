<?php

$conta1 = [
    "titular" => "Vinícius",
    "saldo" => 1000
];
$conta2 = [
    "titular" => "Maria",
    "saldo" => 10000
];
$conta3 = [
    "titular" => "Alberto",
    "saldo" => 300
];


$contaCorrentes = [$conta1, $conta2, $conta3];

for ($i = 0; $i < count($contaCorrentes); $i++) {
    echo "Titular " . $contaCorrentes[$i]["titular"] . "| Saldo "  . $contaCorrentes[$i]["saldo"] .  PHP_EOL;
}
