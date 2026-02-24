<?php

echo "------------------------------------------------" . PHP_EOL;

$dados = ['Vinicios', 10, 24];

//list($nome, $nota, $idade) = $dados;
[$nome, $nota, $idade] = $dados;

var_dump($nome, $nota, $idade);

echo "------------------------------------------------" . PHP_EOL;

$dados = [
    'nome' => 'Vinicios',
    'nota' => 10,
    'idade' => 24
];

//list($nome, $nota, $idade) = $dados;
['nome' => $nome, 'nota' => $nota, 'idade' => $idade] = $dados;

var_dump($nome, $nota, $idade);