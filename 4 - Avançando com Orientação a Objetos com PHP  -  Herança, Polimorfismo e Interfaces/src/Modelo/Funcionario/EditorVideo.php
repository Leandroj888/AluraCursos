<?php
// Alura\Banco\ dá para definir qualquer nome de inicio, porém depois de definido sempre usar ele para indicar a hierarquia

namespace Alura\Banco\Modelo\Funcionario;

class EditorVideo extends Funcionario{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario() * 2;
    }
}