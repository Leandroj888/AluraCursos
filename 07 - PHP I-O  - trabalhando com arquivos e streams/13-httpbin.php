<?php

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "X-from: PHP\r\nContent-Type: text/plain",
        'content' => 'teste de envio'
    ]
    ]);
echo file_get_contents("http://httpbin.org/post", false, $context);