<?php

$contador = 1;

/*
while ($contador <= 15) {
    echo "#$contador" . PHP_EOL;
    $contador = $contador + 1;
}

do {
    echo "#$contador" . PHP_EOL;
    $contador = $contador + 1;
} while ($contador < 15)
*/

/*
$contador = $contador + 1
$contador += 1
$contador++
*/


for ($contador = 1; $contador <= 15; $contador++) {
    if ($contador == 13) {
        continue;
    } elseif ($contador == 14) {
        break;
    }
    echo "#$contador" . PHP_EOL;
}


