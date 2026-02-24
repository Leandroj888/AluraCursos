<?php

//https://www.php.net/manual/en/language.operators.comparison.php

$idade = 15;
$numeroDePessoas = 2;

echo "Você só pode entrar, se tiver mais de 18 anos ou ";
echo "a partir de 16 anos acompanhado" . PHP_EOL;

if ($idade >= 18) {
    echo "Você tem $idade anos. " . PHP_EOL;
    echo "Pode entrar sozinho" . PHP_EOL;
} else if ($idade >= 16 && $numeroDePessoas > 1) { // elseif
    echo "Você tem $idade anos. " . PHP_EOL;
    echo "E está acompanhado, pode entrar" . PHP_EOL;
} else {
    echo "Você tem $idade anos. " . PHP_EOL;
    echo "Você não pode entrar" . PHP_EOL;
}

//Operador ternário
$mensagem = $idade < 18 ? "Você é menor de idade" : "Você é maior de idade";
echo $mensagem . PHP_EOL;

echo "Adeus" . PHP_EOL;