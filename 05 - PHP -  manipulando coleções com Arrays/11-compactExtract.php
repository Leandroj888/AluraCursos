<?php

echo "------------------------------------------------" . PHP_EOL;

$dados = [
    'nome' => 'Vinicios',
    'nota' => 10,
    'idade' => 24
];

//Transforma chaves em variaveis;
extract($dados);

var_dump($nome, $nota, $idade);

echo "------------------------------------------------" . PHP_EOL;

//Transforma as váriaveis em array
$dados = compact('nome', 'nota', 'idade');
var_dump($dados);