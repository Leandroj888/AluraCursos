<?php



echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
// Ler linha a linha

$arquivo = fopen('2-lista-curso.txt','r');
while (!feof($arquivo)) {
    $curso = fgets($arquivo);
    echo $curso;
}
fclose($arquivo);

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
// Ler tudo usando o tamanho do arquivo

$arquivo = fopen('2-lista-curso.txt','r');
$tamanho = filesize('2-lista-curso.txt');
$cursos = fread($arquivo, $tamanho);
echo $cursos;
fclose($arquivo);

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
// Ler tudo sem precisar das funções files anteriores
echo file_get_contents('2-lista-curso.txt');

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;
// Ler tudo e cada linha em um index de um array
var_dump( file('2-lista-curso.txt') );

echo PHP_EOL . "------------------------------------------------" . PHP_EOL;


