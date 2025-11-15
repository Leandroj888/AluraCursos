<?php

$anoNascimento = ' 1988 '; //string numérica válida
$idade = 2022 - $anoNascimento;
echo $idade . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

echo 'Teste 1: ';
echo $anoNascimento == 1988 ? 'Ano igual a 1988' : 'Ano diferente de 1988';
echo PHP_EOL . 'Teste 2: ';
echo $anoNascimento === 1988 ? 'Ano igual a 1988' : 'Ano diferente de 1988';
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$teste = 'dasfdas';
echo 'Teste 3: ';
echo $teste == 0 ? 'PHP antes da 8.0' : 'PHP acima da 8.0';
echo PHP_EOL . 'Teste 4: ';
echo (int) $teste == 0 ? 'Se usa PHP 8.0 você trapaceou' : 'PHP acima da 8.0';
echo PHP_EOL . '-------------------------------------------------' . PHP_EOL;