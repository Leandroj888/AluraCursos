<?php

namespace Alura\Leilao\tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    public function testSem5Lances()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode propor mais de 5 lances');

        $leilao = new Leilao('Variante 0KM');

        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));
        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));
        $leilao->recebeLance(new Lance($joao, 6000));
        $leilao->recebeLance(new Lance($maria, 6500));
        $leilao->recebeLance(new Lance($joao, 7000));

        //self::assertCount(10, $leilao->getLances());
        //$lances = $leilao->getLances();
        //self::assertEquals(6500, end($lances)->getValor());
    }

    public function testSemLanceRepetido()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuário não pode propor 2 lances seguidos');

        $leilao = new Leilao('Variante 0KM');

        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($joao, 2500));

        //self::assertCount(1, $leilao->getLances());
        //self::assertEquals(2000, $leilao->getLances()[0]->getValor());
    }

    /**
     * @dataProvider geraLances
     */
    public function testReceberLances(int $qtdLances, Leilao $leilao, array $valores): void
    {
        foreach ($valores as $i => $valorEsperado) {
            self::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }

        self::assertCount($qtdLances, $leilao->getLances());
        //self::assertEquals(2000, $leilao->getLances()[0]->getValor());
        //self::assertEquals(2500, $leilao->getLances()[1]->getValor());
    }

    public function geraLances()
    {
        $leilaocom2Lances = new Leilao('Fiat 147 0KM');
        $leilaocom1Lance = new Leilao('Fusca 98 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilaocom2Lances->recebeLance(new Lance($joao, 2000));
        $leilaocom2Lances->recebeLance(new Lance($maria, 2500));

        $leilaocom1Lance->recebeLance(new Lance($maria, 5000));

        return [
            '2-lances' => [2, $leilaocom2Lances, [2000,2500]],
            '1-lance' => [1, $leilaocom1Lance, [5000]],
        ];
    }

}
