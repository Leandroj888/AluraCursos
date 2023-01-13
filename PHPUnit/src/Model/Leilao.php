<?php

namespace Alura\Leilao\Model;

use function PHPUnit\Framework\throwException;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;
    private bool $finalizado;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
        $this->finalizado = false;
    }

    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) > 0 && $lance->getUsuario() == end($this->lances)->getUsuario()){
            //return;
            throw new \DomainException("Usuário não pode propor 2 lances seguidos");
        }

        if ($this->totalLanceUsuario($lance->getUsuario()) >= 5) {
            //return;
            throw new \DomainException("Usuário não pode propor mais de 5 lances");
        }

        $this->lances[] = $lance;
    }

    private function totalLanceUsuario(Usuario $usuario): int
    {
        $totalLanceUser = \array_reduce($this->lances,
            function(int $totalAcumulado, Lance $lance) use ($usuario){
                return $usuario == $lance->getUsuario() ? $totalAcumulado +1 : $totalAcumulado;
            }, 0
        );

        return $totalLanceUser;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }
    public function finaliza(): void
    {
        $this->finalizado = true;
    }

    public function estaFinalizado(): bool
    {
        return $this->finalizado;
    }
}
