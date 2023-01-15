<?php

$meus_cursos = file('2-lista-curso.txt');
$outros_cursos = file('5-cursos-php.txt');


$arquivoCsv = fopen('17-curso.csv',  'w');

foreach ($meus_cursos as $curso) {
    $linha = manipularValor($curso, 'Sim');
    //fwrite($arquivoCsv,implode(',', $linha));
    fputcsv($arquivoCsv, $linha, ';');
}

foreach ($outros_cursos as $curso) {
    $linha = manipularValor($curso, 'Não');
    //fwrite($arquivoCsv,implode(',', $linha));
    fputcsv($arquivoCsv, $linha, ';');
}


function manipularValor(string $valor, string $origem): array
{
    //Alerta 8.2 / Depreciada 9
    //$valor = utf8_decode($valor);
    $valor = mb_convert_encoding($valor, 'ISO-8859-1', 'UTF-8') . PHP_EOL;
    $valor = trim($valor);
    return [$valor, $origem];
}