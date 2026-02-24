<?php
// Alura\Banco\ dá para definir qualquer nome de inicio, porém depois de definido sempre usar ele para indicar a hierarquia

namespace Alura\Banco\Modelo\Funcionario;

class Desenvolvedor extends Funcionario{
    public function sobeNivel() {
        $this->recebeAumento($this->recuperaSalario() * 0.75);
    }

    public function calculaBonificacao(): float
    {
        return 500.0;
    }
/*
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario() * 0.05;
    }
*/
}