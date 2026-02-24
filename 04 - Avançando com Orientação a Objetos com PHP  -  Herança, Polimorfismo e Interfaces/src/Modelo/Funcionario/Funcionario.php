<?php
// Alura\Banco\ dá para definir qualquer nome de inicio, porém depois de definido sempre usar ele para indicar a hierarquia

namespace Alura\Banco\Modelo\Funcionario;

use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Pessoa;

abstract class Funcionario extends Pessoa{
    public function __construct(
        Cpf $cpf,
        string $nome,
        private float $salario,
    ) {
        parent::__construct($cpf, $nome);
    }

    public function recuperaSalario(): float
    {
        return $this->salario;
    }

    public function recebeAumento(float $aumento): void
    {
        if ($aumento < 0) {
            throw new \Exception("Valor deve ser positivo", 1);
        }
        $this->salario += $aumento;
    }

    public function alteraNome(string $nome): void
    {
        $this->nome = $nome;
        $this->validaNome();
    }

    abstract function calculaBonificacao(): float;

    /*
    public function calculaBonificacao(): float
    {
        return $this->salario * 0.1;
    }
    */
}