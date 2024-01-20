<?php

use Alura\DesignPattern\Log\FileLogManager;
use Alura\DesignPattern\Log\StdOutLogManager;

require 'vendor/autoload.php';

$logManager = new FileLogManager(__DIR__ . '/log');
$logManager->log('info','testando log Manager');


$logManager = new StdOutLogManager(__DIR__ . '/log');
$logManager->log('info','testando log Manager');