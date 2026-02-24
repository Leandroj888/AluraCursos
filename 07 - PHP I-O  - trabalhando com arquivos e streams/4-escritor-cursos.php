<?php

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;

// w cria o arquivo ou edita ele e sobrescreve os textos mas não apaga geral
// r le o arquivo
// a cria ou edita o arquivo mas escreve só no final
if (!file_exists('5-cursos-php.txt')) {
    $arquivo = fopen('5-cursos-php.txt','a');

    $curso = "\nSymfony Parte 2: Autenticação e HATEOAS";

    fwrite($arquivo, $curso);
    fclose($arquivo);
}

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;


$curso = "\nPHP Doctrine: Introdução ao Mapeamento Objeto-Relacional";

file_put_contents('5-cursos-php.txt', $curso, FILE_APPEND);