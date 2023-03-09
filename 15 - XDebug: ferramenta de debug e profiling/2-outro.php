<?php

function funcao1(string $param): never
{
    $local=1;
    echo $param;
    funcao2();
}

function funcao2(): never
{
    $local=2;
    throw new Exception('Mensagem de Erro');
}

