<?php

$alunos2021 = [
    'Vínicius',
    'Leandro',
    'Maria',
    'José',
    'Henrique',
    'Joaquime',
    'Paulo'
];

$novosAlunos = [
    'Zezinho',
    'Gaspar',
    'Diana'
];

echo "------------------------------------------------" . PHP_EOL;
//Unir arrays sem preservar as chaves int originar
$alunos2022 = array_merge($alunos2021,$novosAlunos);
var_dump($alunos2022);

echo "------------------------------------------------" . PHP_EOL;
//Unir arrays mas preservar as chaves int originar
$alunos2022 = $novosAlunos + $alunos2021;
var_dump($alunos2022);

echo "------------------------------------------------" . PHP_EOL;
//... desempacota (unpacking) os arrays e reinsere em um novo array e permite insserir novos elementos
$alunos2022 = [...$alunos2021, 'Zeca', ...$novosAlunos, 'Tadeu'];
var_dump($alunos2022);



echo "------------------------------------------------" . PHP_EOL;
//... depende do contexto, aqui esses três pontos significa spread operator, que é operador de espalhar e não desempacotar
//dessa forma eu consigo unir vários argumentos em um só

funcao(1,3,2);

function funcao (...$valores) {
    var_dump($valores);
}

funcao2(...[1,3,2]);

function funcao2 ($a, $b, $c) {
    var_dump($b);
}