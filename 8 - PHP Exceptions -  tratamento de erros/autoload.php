<?php

//require_once 'src/Modelo/Conta/Conta.php';
//require_once 'src/Modelo/Pessoa.php';
//require_once 'src/Modelo/Endereco.php';
//require_once 'src/Modelo/Conta/Titular.php';
//require_once 'src/Modelo/Cpf.php';
//Autoloader -> Caregar automaticamente -> transformar use em files -> PSR4

    spl_autoload_register(function (string $class) {
        $base_dir = __DIR__ . '\\src';
        $caminho = str_replace('Alura\\Banco', $base_dir, $class);
        $caminho = str_replace('\\', DIRECTORY_SEPARATOR, $caminho);
        $caminho = $caminho . '.php';

        if (file_exists($caminho)) {
            require_once $caminho;
        }
    });