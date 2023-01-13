<?php

$notas = [
    'Leandro' => 10,
    'Maria' => 8,
    'José' => 9,
    'Henrique' => 7,
    'Joaquime' => 6,
];

var_dump($notas);
echo "------------------------------------------------" . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;

//Ordem Crescente - sem perder as chaves
asort($notas);
var_dump($notas);

echo "------------------------------------------------" . PHP_EOL;

//Ordem Decrescente - sem perder as chaves
arsort($notas);
var_dump($notas);

echo "------------------------------------------------" . PHP_EOL;

//Ordem Crescente - pelas chaves
ksort($notas);
var_dump($notas);

echo "------------------------------------------------" . PHP_EOL;

//Ordem Decrescente - pelas chaves
krsort($notas);
var_dump($notas);

echo "------------------------------------------------" . PHP_EOL;

//Ordem Decrescente - perde as chaves
rsort($notas);
var_dump($notas);


//usort -> uksort parecido mas usa keys