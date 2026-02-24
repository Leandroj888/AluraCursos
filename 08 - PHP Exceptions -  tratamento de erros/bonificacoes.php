<?php

require_once("autoload.php");

use Alura\Banco\Modelo\Conta\{ContaPoupanca, ContaCorrente, Conta, Titular};
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Funcionario\Desenvolvedor;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Modelo\Funcionario\EditorVideo;
use Alura\Banco\Modelo\Funcionario\Gerente;
use Alura\Banco\Service\ControladorDeBonificacoes;

$umFuncionario = new Desenvolvedor(new Cpf('721.872.330-65'),'Vinícius',1000);
$umaFuncionaria = new Gerente(new Cpf('782.889.360-40'),'Patricia',3000);
$outraFuncionaria = new Diretor(new Cpf('008.367.680-51'),'Luzia',5000);
$editor = new EditorVideo(new Cpf('249.661.580-95'),'Carlinhos',1500);

$umFuncionario->sobeNivel();

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacaoDe($umFuncionario);
$controlador->adicionaBonificacaoDe($umaFuncionaria);
$controlador->adicionaBonificacaoDe($outraFuncionaria);
$controlador->adicionaBonificacaoDe($editor);

echo $controlador->recuperaTotal() . PHP_EOL;