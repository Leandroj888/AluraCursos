<?php
//https://www.php.net/manual/pt_BR/book.mbstring.php

$string = "Teste de Integração PHP"; //23 CHARACTERES


echo strlen($string) . PHP_EOL;
echo strtoupper($string). PHP_EOL;
echo strtolower($string). PHP_EOL;

echo "--------------" . PHP_EOL;

echo mb_strlen($string) . PHP_EOL;
echo mb_strtoupper($string). PHP_EOL;
echo mb_strtolower($string). PHP_EOL;
echo mb_convert_case($string, MB_CASE_TITLE). PHP_EOL;

echo "--------------" . PHP_EOL;

$convertida = mb_convert_encoding($string, 'ISO-8859-1','UTF8');
echo $convertida . PHP_EOL;
