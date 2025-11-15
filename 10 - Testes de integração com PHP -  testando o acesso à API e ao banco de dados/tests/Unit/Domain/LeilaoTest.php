<?php

namespace Alura\Leilao\Tests\Unit\Domain;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use DomainException;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    private Usuario $userMock;
    private Lance $lanceMock;
    protected function setUp(): void
    {
        $this->userMock = $this->createMock(Usuario::class);
        $this->lanceMock = $this->createMock(Lance::class);
        $this->lanceMock->method('getUsuario')->willReturn($this->userMock);
        
    }
    
    public function testProporLanceEmLeilaoFinalizadoDeveLancarExcecao()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Este leilão já está finalizado');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->finaliza();

        $leilao->recebeLance($this->lanceMock);
    }

    /**
     * @param int $qtdEsperado
     * @param Lance[] $lances
     * @dataProvider dadosParaProporLances
     */
    public function testProporLancesEmLeilaoDeveFuncionar(int $qtdEsperado, array $lances)
    {
        $leilao = new Leilao('Fiat 147 0KM');
        foreach ($lances as $lance) {
            $leilao->recebeLance($lance);
        }

        static::assertCount($qtdEsperado, $leilao->getLances());
    }

    public function testMesmoUsuarioNaoPodeProporDoisLancesSeguidos()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Usuário já deu o último lance');

        $leilao = new Leilao('Objeto inútil');

        $leilao->recebeLance($this->lanceMock);
        $leilao->recebeLance($this->lanceMock);
    }

    public function dadosParaProporLances()
    {        
        $user1Mock = $this->createMock(Usuario::class);
        $user1Mock->method('getNome')->willReturn('Usuário 1');
        $lance1Mock = $this->createMock(Lance::class);
        $lance1Mock->method('getUsuario')->willReturn($user1Mock);
        
        $user2Mock = $this->createMock(Usuario::class);
        $user2Mock->method('getNome')->willReturn('Usuário 2');
        $lance2Mock = $this->createMock(Lance::class);
        $lance2Mock->method('getUsuario')->willReturn($user2Mock);
        
        return [
            [1, [$lance1Mock]],
            [2, [$lance1Mock, $lance2Mock]],
        ];
    }
}
