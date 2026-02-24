<?php

$url = 'https://alura.com.br';




echo str_starts_with($url, 'https') ? "URL Segura" : "URL Insegura";
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

echo str_ends_with($url, '.br') ? "URL Brasileira" : "URL Gringa";
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;
