<?php

namespace Alura\DesignPattern\Http;

class ReactPHPHttpAdapter implements HttpAdapter
{
    public function post(string $url, array $data = []): void
    {
        //instancia o react pgpg
        // prepara os dados
        // faço a requisição
        echo "ReactPHP";
    }
}
