<?php

$texto = 'Texto com qualquer coisa poxa e caramba e fdp';
echo '-------------------------------------------------' . PHP_EOL;

$textoNew = str_replace('poxa', '***', $texto);
echo $textoNew . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$textoNew = str_replace(['poxa', 'caramba', 'fdp'], '***', $texto);
echo $textoNew . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$textoNew = str_replace(['poxa', 'caramba'], ['p...', 'c...'], $texto);
echo $textoNew . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

//função a seguir trabalha com character
$textoNew = strtr($texto, 'poxa', '***');
echo $textoNew . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

//função a seguir trabalha com palavra
$textoNew = strtr($texto, ['poxa'=> 'p...', 'caramba'=> 'c...', 'fdp' => '...']);
echo $textoNew . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;


$trans = ['hello' => 'hi', 'hi' => 'hello'];
$texto = "hi all, I said hello";

echo 'Teste 1: ' . strtr($texto,$trans) . PHP_EOL;
echo 'Teste 2: ' . str_replace(array_keys($trans), array_values($trans), $texto)  . PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

