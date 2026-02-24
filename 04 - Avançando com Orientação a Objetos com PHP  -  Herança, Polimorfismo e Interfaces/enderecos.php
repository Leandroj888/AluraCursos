<?php

require_once("autoload.php");

use Alura\Banco\Modelo\Conta\Conta;
use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;


$endereco1 = new Endereco('Petrópolis','um Bairro','minha rua','71b');
$endereco2 = new Endereco('Petrópolis','outro Bairro','outra rua','1d');

echo $endereco1 . PHP_EOL;
echo $endereco2 . PHP_EOL;

echo "------------------------------------------------" . PHP_EOL;

$endereco2->bairro = "Nova Orleas";
echo $endereco2->bairro . PHP_EOL;

