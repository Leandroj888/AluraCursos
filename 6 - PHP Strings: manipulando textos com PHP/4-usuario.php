<?php

$nome  = 'Leandro Junges';
$email = ' leanDróJungÉs@yahoo.com.br ';
$senha = '123';

$indexArroba = strpos($email, '@');

$usuario = substr($email, 0, $indexArroba);
echo $usuario;
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

echo substr($email, $indexArroba + 1);
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

// A função comentada retorna o número de bytes (á esse characteres conta como dois) a segunta retorna os characteres contados,
//echo strlen($senha) > 5 ? "Senha segura" : "Senha insegura";
echo mb_strlen($senha) > 5 ? "Senha segura" : "Senha insegura";
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

//echo strtoupper($usuario);
echo mb_strtoupper($usuario);
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

//echo strtolower($usuario);
echo mb_strtolower($usuario);
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

//echo strtolower($usuario);
list($nome, $sobrenome) = explode(' ', $nome);
echo "Nome: $nome, Sobrenome: $sobrenome";
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$csv = 'Vinicius Dias,24,vini@alura.com.br';
$elements = explode(',', $csv, 2);
var_dump($elements);
$csv2 = implode(';',$elements);
var_dump($csv2);
echo '-------------------------------------------------' . PHP_EOL;


echo trim($email,'');
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;