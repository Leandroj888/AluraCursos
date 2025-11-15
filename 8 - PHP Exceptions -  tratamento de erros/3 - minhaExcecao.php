<?php

use PhpParser\Node\Stmt\TryCatch;

class minhaExcecao extends Exception
{
    public function teste() {
        echo "teste" . PHP_EOL;
    }
}

try {
    throw new minhaExcecao();
} catch(minhaExcecao $e) {
    $e->teste();
}