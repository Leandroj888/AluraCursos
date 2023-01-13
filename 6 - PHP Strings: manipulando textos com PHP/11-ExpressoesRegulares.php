<?php

$telefones = ['(99) 9999 - 9999','(88) 98888 - 8888','(77) 7777 - 7777'];

foreach ($telefones as $item) {
    // o / no ínicio e fim da expressão é para delimitar a expressão
    // ^ inicio da string $ fim da string
    //$telefoneValido = preg_match("/^\(\d{2}\) 9?\d{4} - \d{4}$/",$item);
    
    // o terceiro parâmetro tras tanto a validação geral quanto os grupos separados (\d)
    // após o delimitador final pode ter modificadores como gm - g não retorna após primeiro match | m multiline
    
    $regex = "/^(\(\d{2}\)) (9?\d{4} - \d{4})$/";
    $telefoneValido = preg_match($regex, $item, $validacoes);
    //var_dump($validacoes);
    echo $telefoneValido ? "Telefone $item válido" : "Telefone $item inválido"; 
    echo PHP_EOL;
    
    //modifica o primeiro grupo e usa inteiro o segundo grupo\2
    echo preg_replace($regex, '(XX) \2', $item);
    echo PHP_EOL;
}

