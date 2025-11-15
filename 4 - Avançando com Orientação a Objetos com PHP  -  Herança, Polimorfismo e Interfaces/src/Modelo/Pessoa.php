<?php
// Alura\Banco\ dá para definir qualquer nome de inicio, porém depois de definido sempre usar ele para indicar a hierarquia

namespace Alura\Banco\Modelo;

class Pessoa {
    public function __construct(
        public readonly Cpf $cpf,
        private string $nome,
    ) {
        $this->validaNome();
    }

    final protected function validaNome(): void
    {
        if (mb_strlen($this->nome) < 5) {
            throw new \Exception("Nome precisa ter pelo menos 5 characteres" , 1);
        }
    }

    public function recuperaNome(): string
    {
        return $this->nome;
    }
}