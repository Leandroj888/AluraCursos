<?php
//https://www.php.net/manual/pt_BR/types.comparisons.php
$array = [
    1 => 'a',
    '1' => 'b',
    1.5 => 'c',
    true => 'd',
    'qualquerCoisa' => 'e',
];

foreach ($array as $item) {
    echo "$item" . PHP_EOL;
}