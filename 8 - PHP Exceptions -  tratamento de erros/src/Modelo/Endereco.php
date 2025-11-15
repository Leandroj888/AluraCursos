<?php
// Alura\Banco\ dá para definir qualquer nome de inicio, porém depois de definido sempre usar ele para indicar a hierarquia

namespace Alura\Banco\Modelo;

/**
 * @property-read string $cidade
 * @property-read string $bairro
 * @property-read string $rua
 * @property-read string $numero
 */

 // Não permite herança dessa class
final class Endereco {
    use AcessoPropriedades;

    public function __construct (
        private string $cidade,
        private string $bairro,
        private string $rua,
        private string $numero,
    ) {

    }

    public function __toString(): string
    {
        return "{$this->rua}, {$this->numero}, {$this->bairro}, {$this->cidade}";
    }

    public function recuperaCidade(): string
    {
        return $this->cidade;
    }

    public function recuperaBairro(): string
    {
        return $this->bairro;
    }

    public function recuperaRua(): string
    {
        return $this->rua;
    }

    public function recuperaNumero(): string
    {
        return $this->numero;
    }
/*
    public function __get(string $nomeAtributo): string
    {
        $metodo = "recupera" . ucfirst($nomeAtributo);
        return $this->$metodo();
    }

    public function __set(string $nomeAtributo, string $valor): void
    {
        $this->$nomeAtributo = $valor;
    }
*/
}
