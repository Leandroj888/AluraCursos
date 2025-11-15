<?php

use Alura\DesignPattern\Http\CurlHttpAdapter;
use Alura\DesignPattern\Http\ReactPHPHttpAdapter;
use Alura\DesignPattern\RegistroOrcamento;

require 'vendor/autoload.php';

//$registroOrcamento = new RegistroOrcamento(new CurlHttpAdapter);
$registroOrcamento = new RegistroOrcamento(new ReactPHPHttpAdapter);