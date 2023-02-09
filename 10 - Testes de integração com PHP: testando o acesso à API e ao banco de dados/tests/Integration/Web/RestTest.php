<?php

namespace Alura\Leilao\Tests\Integration\Web;

use PHPUnit\Framework\TestCase;

class RestTest extends TestCase
{
    public function testApiRestRetornarLeiloes()
    {
        //Melhor forma seria usar um framework tipo symfony, dessa forma têm que ter o server de pé
        $resposta = file_get_contents("http://localhost:8081/rest.php");
        
        self::assertIsArray(json_decode($resposta));
        self::assertStringContainsString('200 OK',$http_response_header[0]);
    }
}
