<?php

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

// stdin -> nada mais é do que o teclado, indiferente do modo sempre será r
// todos php:// fclose e executado automaticamente.
$teclado = fopen('php://stdin', 'r');

$novoCurso = fgets($teclado);

file_put_contents('2-lista-curso.txt', $novoCurso, FILE_APPEND);

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

$novoCurso = fgets(STDIN);

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
