<?php
$email = ' leanDróJungÉs@yahoo.com.br ';

echo 'trim: ' . trim($email);
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$email = 'brrendom@yahoo.com.br';


echo 'trim(rb.): ' . trim($email,'rb.');
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$email = 'brrendom@yahoo.com.br';


echo 'ltrim: ' . ltrim($email,'rb.');
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;

$email = 'brrendom@yahoo.com.br';


echo 'rtrim: ' . rtrim($email,'rb.');
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;