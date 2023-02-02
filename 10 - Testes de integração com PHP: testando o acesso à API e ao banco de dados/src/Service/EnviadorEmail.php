<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;
use Exception;

class EnviadorEmail
{
    public function notificarTerminoLeilao(Leilao $leilao)
    {
        $sucesso = mail(
            'usuario@email.com', 
            'Leilão Finalizado', 
            "O leilao para {$leilao->recuperarDescricao()} foi finalizado"
        );
        
        if(!$sucesso) {
            throw new \DomainException("Email não enviado");
        }
    }
}
