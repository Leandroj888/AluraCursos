<?php

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
// saida na tela
$tela = fopen('php://stdout', 'w');
fwrite($tela, "Olá Mundo");

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

// saida de erro
$tela = fopen('php://stderr', 'w');
fwrite($tela, "Olá Erro");

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

fwrite(STDOUT, "Olá Mundo");

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

fwrite(STDERR, "Olá Erro");

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

$curso =  fopen('zip://7-arquivos.zip#2-lista-curso.txt', 'r');
stream_copy_to_stream($curso, STDOUT);

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;