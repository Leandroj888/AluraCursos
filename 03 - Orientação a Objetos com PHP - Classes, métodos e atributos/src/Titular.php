<?php

class Titular {
    public function __construct(
        public readonly Cpf $cpfTitular,
        public readonly string $nomeTitular
    ) {
        $this->validaNomeTitular();
    }

    private function validaNomeTitular(): void
    {
        if (strlen($this->nomeTitular) < 5) {
            throw new Exception("Nome precisa ter pelo menos 5 characteres" , 1);
        }
    }
}