<?php

$context = stream_context_create([
    'zip' => [
        'password' => '123456'
        ]
    ]);
echo file_get_contents("zip://14-arquivosSenha.zip#2-lista-curso.txt", false, $context);