<?php

class Cpf {
    public function __construct(
        public readonly string $cpf,
    ) {
        $this->validaFormatoCpf();
        $this->validaDigitoCpf();
    }

    private function validaFormatoCpf(): void
    {
        $numero = filter_var($this->cpf, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'
            ]
        ]);
        if ($numero === false) {
            throw new Exception("CPF Inválido" , 1);
        }
    }

    private function validaDigitoCpf(): void
    {
        $cpf = $this->cpf;
        $cpf  = preg_replace( '/[^0-9]/', '',$cpf);
        $cpfSplint = str_split($cpf);


        $acumulador = 0;
        $multiplicador = 10;
        foreach($cpfSplint as $numero){
            $acumulador += (int) $numero * $multiplicador;
            $multiplicador--;
            if ($multiplicador < 2) {
                break;
            }
        }

        $digito = 11 - ($acumulador % 11);
        if ($digito > 9) {
            $digito = 0;
        }
        if ($digito != $cpfSplint[9]) {
            throw new Exception("CPF Inválido" , 1);
        }

        $acumulador = 0;
        $multiplicador = 11;
        foreach($cpfSplint as $numero){
            $acumulador += (int) $numero * $multiplicador;
            $multiplicador--;
            if ($multiplicador < 2) {
                break;
            }
        }

        $digito = 11 - ($acumulador % 11);
        if ($digito > 9) {
            $digito = 0;
        }
        if ($digito != $cpfSplint[10]) {
            throw new Exception("CPF Inválido" , 1);
        }
    }
}
