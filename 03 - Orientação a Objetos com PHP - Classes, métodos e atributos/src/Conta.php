<?php

require_once 'src/Titular.php';
require_once 'src/Cpf.php';

//$umaNovaConta = new Conta();
//$umaNovaConta->cpfTitular = '123.456.789-10'

//require_once 'src/Conta.php';
//$contaUm = new Conta();
//$contaDois = new Conta();
//$contaUm->depositar(500);
//$contaUm->transferir(200, $contaDois);
//echo $contaUm->saldo;

class Conta {
    //public string $cpfTitular;
    //public string $nomeTitular;
    //public float $saldo = 0;

    private float $saldo = 0;
    private static int $numeroDeContas = 0; // variáveis staticas são globais para a class

    public function __construct(
        public readonly Titular $titular
    ) {
        echo "Criando nova conta " . $this->titular->cpfTitular->cpf . PHP_EOL;
        $this->saldo = 0;

        self::$numeroDeContas++;
    }


    /*
    public function __construct(
        public readonly string $cpfTitular,
        public readonly string $nomeTitular)
    {
        $this->validaNomeTitular();

        echo "Criando nova conta " . $this->cpfTitular . PHP_EOL;
        $this->saldo = 0;

        self::$numeroDeContas++;
    }
    */

    public function __destruct()
    {
        echo "Apagando a Conta " . $this->titular->cpfTitular->cpf . PHP_EOL;
        self::$numeroDeContas--;
    }

    /*
    public function defineCpfTitular(string $cpfTitular): void
    {
        $this->cpfTitular = $cpfTitular;
    }
    public function defineNomeTitular(string $nomeTitular): void
    {
        $this->nomeTitular = $nomeTitular;
    }
    public function recuperaCpfTitular(): string
    {
        return $this->cpfTitular;
    }
    public function recuperaNomeTitular(): string
    {
        return $this->nomeTitular;
    }

    private function validaNomeTitular()
    {
        if (strlen($this->nomeTitular) < 5) {
            throw new Exception("Nome precisa ter pelo menos 5 characteres" , 1);
        }
    }
    */



    public function recuperaSaldo(): float
    {
        return $this->saldo;
    }

    public function sacar(float $valor): void
    {
        if ($valor < 0 || $valor > $this->saldo){
            echo $valor < 0 ? "Sacar precisam ser positivo" : "Saldo indisponível";
            return;
        }

        $this->saldo -= $valor;
    }

    public function depositar(float $valor): void
    {
        if ($valor < 0){
            echo "Depósitos precisam ser positivo";
            return;
        }

        $this->saldo += $valor;
    }

    public function transferir(float $valor, Conta $destino): void
    {
        $this->sacar($valor);
        $destino->depositar($valor);
    }

    public static function recuperaNumeroDeContas(): int {
        return self::$numeroDeContas;
    }
}