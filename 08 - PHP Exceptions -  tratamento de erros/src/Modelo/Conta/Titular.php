<?php
// Alura\Banco\ dá para definir qualquer nome de inicio, porém depois de definido sempre usar ele para indicar a hierarquia
// Boa prática é usar namespace com nome de pasta

namespace Alura\Banco\Modelo\Conta;

use Alura\Banco\Modelo\Autenticavel;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\Pessoa;

class Titular extends Pessoa implements Autenticavel
{
    public function __construct(
        Cpf $cpf,
        string $nome,
        private Endereco $enderecoTitular,
    ) {
        parent::__construct($cpf, $nome);
    }

    public function recuperaEnderecoTitular(): Endereco
    {
        return $this->enderecoTitular;
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === 'abcd';
    }
}