<?php

$arquivo = fopen('php://temp','w');

try {
    echo "Executando" . PHP_EOL;
    //throw new Exception("Exceção aqui", 1);
    fwrite($arquivo, "Qualquer coisa");
} catch (Exception) {
    echo "Caiu no catch" . PHP_EOL;
} finally {
    echo "Finally" . PHP_EOL;
    fclose($arquivo);
}
echo "Fim" . PHP_EOL;

echo a() . PHP_EOL;

function a(): int 
{
    try {
        echo "Código" . PHP_EOL;
        return 0;
    } catch (Exception){
        echo "Problema" . PHP_EOL;
        return 1;
    } finally {
        //vai forçar essa execução mesmo tendo o return
        echo "Final da função" . PHP_EOL;
    }
}