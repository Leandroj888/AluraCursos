<?php

error_reporting(E_ALL); // PHP 8 - Já vai mostrar todos os erros
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', "app.log");

define('CONSTANT', 'VALOR1');
const CONSTANTE = 'VALOR2';

// PHP 7 - NOTICE / PHP 8 - WARNING
echo $e[12] . PHP_EOL;


echo 'teste' . PHP_EOL;

// PHP 7 - WARNING / PHP 8 - ERROR
try {
    echo CONSTAN . PHP_EOL;
} catch (Error $e) {
    echo $e->getMessage(). PHP_EOL;
}

echo CONSTANT . PHP_EOL;
echo CONSTANTE . PHP_EOL;



