<?php

require_once("autoload.php");

use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Service\Autenticador;

$diretor = new Diretor(new Cpf('008.367.680-51'),'Luzia',5000);

$autenticador = new Autenticador();
$autenticador->tentaLogin($diretor, 1234);