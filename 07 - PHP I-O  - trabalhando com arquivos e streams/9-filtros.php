<?php

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

$arquivoCursos = fopen('2-lista-curso.txt','r');
stream_filter_append($arquivoCursos, 'string.toupper');

$tamanho = filesize('2-lista-curso.txt');
$cursos = fread($arquivoCursos, $tamanho);
echo $cursos;


echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

require_once '10-MeuFiltro.php';

stream_filter_register('MeuFiltro', MeuFiltro::class);

$arquivoCursos = fopen('2-lista-curso.txt','r');
stream_filter_append($arquivoCursos, 'MeuFiltro');

$tamanho = filesize('2-lista-curso.txt');
$cursos = fread($arquivoCursos, $tamanho);
echo $cursos;

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
