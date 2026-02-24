<?php

namespace Alura\Banco\Modelo;

trait AcessoPropriedades
{
    public function __get(string $nomeAtributo): string
    {
        $metodo = "recupera" . ucfirst($nomeAtributo);
        return $this->$metodo();
    }

    public function __set(string $nomeAtributo, string $valor): void
    {
        $this->$nomeAtributo = $valor;
    }

}