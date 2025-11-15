<?php

$notasBimestre1 = [
    'Vínicius' => 1,
    'Leandro' => 10,
    'Maria' => 8,
    'José' => 8,
    'Henrique' => 7,
    'Joaquime' => 6,
    'Paulo'=>2
];

$notasBimestre2 = [
    'Vínicius' => 7,
    'Leandro' => 10,
    'Maria' => 8,
    'Henrique' => 7,
    'Joaquime' => 6,
];

echo "------------------------------------------------" . PHP_EOL;
// Valida os elemento do 1 array com outros mas só o valor
var_dump(array_diff($notasBimestre1,$notasBimestre2));

echo "------------------------------------------------" . PHP_EOL;
// Valida os elemento do 1 array com outros mas só as key
var_dump(array_diff_key($notasBimestre1,$notasBimestre2));

echo "------------------------------------------------" . PHP_EOL;
// Valida os elemento do 1 array com outros validando tudo
var_dump(array_diff_assoc($notasBimestre1,$notasBimestre2));

echo "------------------------------------------------" . PHP_EOL;
$faltantes = array_diff_key($notasBimestre1,$notasBimestre2);
// Pegar só as key de um array
var_dump(array_keys($faltantes));

echo "------------------------------------------------" . PHP_EOL;
// Pegar só os values de um array
var_dump(array_values($faltantes));

echo "------------------------------------------------" . PHP_EOL;
// Combinar arrays
$alunos = array_keys($faltantes);
$notas = array_values($faltantes);
var_dump(array_combine($notas,$alunos));

echo "------------------------------------------------" . PHP_EOL;
// Inverter key por value
var_dump(array_flip($faltantes));