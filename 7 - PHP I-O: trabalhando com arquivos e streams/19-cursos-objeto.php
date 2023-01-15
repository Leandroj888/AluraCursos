<?php

$arquivoCursos = new SplFileObject('17-curso.csv');

while (!$arquivoCursos->eof()) {
    $linha = $arquivoCursos->fgetcsv(';');

    //Alerta 8.2 / Depreciada 9
    //echo utf8_encode($linha[0]) . PHP_EOL;
    echo mb_convert_encoding($linha[0], 'UTF-8', 'ISO-8859-1') . PHP_EOL;
}

$date = new DateTime();
$date->setTimestamp($arquivoCursos->getCTime());
echo $date->format('d/m/Y') . PHP_EOL;