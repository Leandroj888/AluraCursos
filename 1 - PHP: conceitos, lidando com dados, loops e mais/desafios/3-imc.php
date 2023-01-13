<?php

$altura = 1.85;
$peso = 130;


$imc = $peso / $altura ** 2;

echo "Seu IMC é $imc você está ";

if ($imc < 18.6 ) {
    echo "abaixo do peso";
} elseif  ($imc < 25 ) {
    echo "no peso ideal";
}  elseif  ($imc < 30 ) {
    echo "com sobrepeso";
}  elseif  ($imc < 35 ) {
    echo "com obesidade 1";
}  elseif  ($imc < 40 ) {
    echo "com obesidade 2";
}  else {
    echo "com obesidade 3";
}

echo PHP_EOL;