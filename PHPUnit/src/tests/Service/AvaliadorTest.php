<?php

namespace Alura\Leilao\tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use DomainException;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private Avaliador $leloeiro;

    protected function setUp(): void
    {
        $this->leloeiro = new Avaliador();
    }

    public function criarLeilaoCrescente()
    {
        // arruma a casa pra teste - Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $luis = new Usuario('Luis');
        $leandro = new Usuario('Leandro');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($luis, 3000));
        $leilao->recebeLance(new Lance($leandro, 4000));

        return ['Crescente' => [$leilao]];
    }

    public function criarLeilaoDecrescente()
    {
        // arruma a casa pra teste - Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $luis = new Usuario('Luis');
        $leandro = new Usuario('Leandro');


        $leilao->recebeLance(new Lance($leandro, 4000));
        $leilao->recebeLance(new Lance($luis, 3000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        return ['Decrescente' => [$leilao]];
    }

    public function criarLeilaoAleatorio()
    {
        // arruma a casa pra teste - Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $luis = new Usuario('Luis');
        $leandro = new Usuario('Leandro');


        $leilao->recebeLance(new Lance($luis, 3000));
        $leilao->recebeLance(new Lance($leandro, 4000));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        return ['Aleatorio' => [$leilao]];
    }

    /**
     * @dataProvider criarLeilaoCrescente
     * @dataProvider criarLeilaoDecrescente
     * @dataProvider criarLeilaoAleatorio
     */
    public function testAvaliarLanceMaior(Leilao $leilao): void
    {

        // arruma a casa pra teste - Arrange - Given
        //$leilao = $this->criarLeilao();

        //$leloeiro = new Avaliador();

        // executa o código a ser testado - Act -when
        $this->leloeiro->avalia($leilao);

        $maiorValor = $this->leloeiro->getMaiorValor();


        // verifica valores - Assert - Then
        $valorEsperado = 4000;

        //$this->assertEquals($valorEsperado,$maiorValor);
        self::assertEquals($valorEsperado,$maiorValor);
    }

    /**
     * @dataProvider criarLeilaoCrescente
     * @dataProvider criarLeilaoDecrescente
     * @dataProvider criarLeilaoAleatorio
     */
    public function testAvaliarLanceMenor(Leilao $leilao): void
    {

        // arruma a casa pra teste - Arrange - Given
        //$leilao = $this->criarLeilao();

        //$leloeiro = new Avaliador();

        // executa o código a ser testado - Act -when
        $this->leloeiro->avalia($leilao);

        $menorValor = $this->leloeiro->getMenorValor();

        // verifica valores - Assert - Then
        $valorEsperado = 2000;

        //$this->assertEquals($valorEsperado,$maiorValor);
        self::assertEquals($valorEsperado,$menorValor);
    }

    /**
     * @dataProvider criarLeilaoCrescente
     * @dataProvider criarLeilaoDecrescente
     * @dataProvider criarLeilaoAleatorio
     */
    public function testAvaliarLanceMaiores(Leilao $leilao): void
    {

        // arruma a casa pra teste - Arrange - Given
        //$leilao = $this->criarLeilao();

        //$leloeiro = new Avaliador();

        // executa o código a ser testado - Act -when
        $this->leloeiro->avalia($leilao);

        $menorValor = $this->leloeiro->getMaioresLances();

        self::assertCount(3,$menorValor);
        self::assertEquals(4000, $menorValor[0]->getValor());
        self::assertEquals(3000, $menorValor[1]->getValor());
        self::assertEquals(2500, $menorValor[2]->getValor());
    }

    public function testLeilaoVazio()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar leilão');

        $leilao = new Leilao('Fiat 147 0KM');
        $this->leloeiro->avalia($leilao);
        /*
        try {
            $leilao = new Leilao('Fiat 147 0KM');
            $this->leloeiro->avalia($leilao);

            static::fail('Exceção deveria ter sido lançada');
        } catch (\DomainException $exception) {
            static::assertEquals('Não é possível avaliar leilão', $exception->getMessage());
        }
        */
    }

    public function testLeilaoFinalizadoAvaliar()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Leilão já finalzado');

        $leilao = new Leilao('Fiat 147 0KM');
        $luis = new Usuario('Luis');
        $leilao->recebeLance(new Lance($luis, 3000));
        $leilao->finaliza();

        $this->leloeiro->avalia($leilao);
    }
}
