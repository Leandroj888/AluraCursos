<?php

$alunos2022 = [
    'Vínicius',
    'Leandro',
    'Maria',
    'José',
    'Henrique',
    'Joaquime',
    'Paulo'
];

echo "------------------------------------------------" . PHP_EOL;
//Adicionar vários elementos ao fim
array_push($alunos2022,'Alice','Tuco','Zeca');
var_dump($alunos2022);


echo "------------------------------------------------" . PHP_EOL;
//Adicionar um elementos ao fim
$alunos2022[] = 'Zina';
var_dump($alunos2022);


echo "------------------------------------------------" . PHP_EOL;
//Adicionar um ou mais elementos no inicio
array_unshift($alunos2022,'Stephani');
var_dump($alunos2022);


echo "------------------------------------------------" . PHP_EOL;
//Remove o primeiro elemento
$elemento = array_shift($alunos2022);
var_dump($elemento);
var_dump($alunos2022);

echo "------------------------------------------------" . PHP_EOL;
//Remove o último elemento
$elemento = array_pop($alunos2022);
var_dump($elemento);
var_dump($alunos2022);