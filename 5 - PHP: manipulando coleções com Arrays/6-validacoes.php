<?php

$notas = [
    'Vínicius' => null,
    'Leandro' => 10,
    'Maria' => 8,
    'José' => 9,
    'Henrique' => 7,
    'Joaquime' => 6,
];

var_dump($notas);
echo "------------------------------------------------" . PHP_EOL;

//if (gettype($notas) === 'array') {
if (is_array($notas)) {
    echo 'Sim, é um array' . PHP_EOL;
}

echo "------------------------------------------------" . PHP_EOL;
// possui indices numéricos e é sequencial
var_dump(array_is_list($notas));

echo "------------------------------------------------" . PHP_EOL;
var_dump(array_key_exists('José', $notas));

echo "------------------------------------------------" . PHP_EOL;

echo 'Vínicius fez a prova: ';
var_dump(isset($notas['Vínicius']));

echo "------------------------------------------------" . PHP_EOL;

echo 'Alguém tirou 10: ';
var_dump(in_array(10, $notas, true));

echo "------------------------------------------------" . PHP_EOL;
// terceiro valor strict seria a comparação ===
echo 'Quem tirou 10: ';
var_dump(array_search(10, $notas, true));