<?php

require 'FlatArray.php';

$array = [];
for ($i=0; $i< 10000; $i++) {
    array_push($array, [$i, $i + 1, $i + 2]);
}

$flatArray = New FlatArray($array);

foreach ($flatArray as $value) {
    echo $value . PHP_EOL;
}