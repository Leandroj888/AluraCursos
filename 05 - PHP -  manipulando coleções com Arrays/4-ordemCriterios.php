<?php

$notas = [
    ['aluno' => 'Leandro', 'nota' => 10],
    ['aluno' => 'Maria', 'nota' => 8],
    ['aluno' => 'José', 'nota' => 9],
    ['aluno' => 'Henrique', 'nota' => 7],
];

var_dump($notas);
echo "------------------------------------------------" . PHP_EOL;

//Ordem Crescente
usort($notas, 'ordenarNota');
var_dump($notas);


function ordenarNota(array $nota1, array $nota2) {
    return $nota2['nota'] <=> $nota1['nota'];
    /*
    if($nota1['nota'] > $nota2['nota']) {
        return -1;
    }

    if($nota2['nota'] > $nota1['nota']) {
        return 1;
    }

    return 0;
    */
}