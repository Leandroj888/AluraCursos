<?php

$array = [
    1 => 'um',
    2 => 'dois',
];

var_dump($array);

foreach ($array as $key => $value) {
    echo "$key -> $value" . PHP_EOL;
}
echo "------------------------------------------------" . PHP_EOL;

echo "Total de Registros: " . count($array) . PHP_EOL;
echo "Total de Registros: " . sizeof($array) . PHP_EOL;