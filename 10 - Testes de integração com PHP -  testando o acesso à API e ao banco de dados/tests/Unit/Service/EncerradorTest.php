<?php

namespace Alura\Leilao\tests\Unit\Service;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Service\Encerrador;
use Alura\Leilao\Service\EnviadorEmail;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/*
class LeilaoDaoMock extends LeilaoDao 
{
    private $leiloes = [];
    
    public function salva(Leilao $leilao): void
    {
        $this->leiloes[] = $leilao;
    }
    
    public function recuperarNaoFinalizados(): array
    {
        return array_filter($this->leiloes, function (Leilao $leilao) { 
            return !$leilao->estaFinalizado(); 
        });
    }
    
    public function recuperarFinalizados(): array
    {
        return array_filter($this->leiloes, function (Leilao $leilao) { 
            return $leilao->estaFinalizado(); 
        });
    }
    
    public function atualiza(Leilao $leilao): void
    {
        
    }
}
*/

class EncerradorTest extends TestCase
{
    private Encerrador $encerrador;
    private Leilao $fiat147;
    private Leilao $variant;
    
    /** @var MockObject */
    private EnviadorEmail $email;
    
    protected function setUp(): void
    {
        $this->fiat147 = new Leilao(
            'Fiat 147 0KM',
            new DateTimeImmutable('8 days ago')
        );
        
        $this->variant = new Leilao(
            'Variant 1972 0KM',
            new DateTimeImmutable('10 days ago')
        );
        
        /**
         *  1 Método criar na raça usando extends - stub
         * 
         * $leilaoDao = new LeilaoDaoMock();
         * $leilaoDao->salva($fiat147);
         * $leilaoDao->salva($variant);
         */
        
        $leilaoDao = $this->createMock(LeilaoDao::class);
        
        $leilaoDao->method('recuperarNaoFinalizados')->willReturn([$this->fiat147, $this->variant]);
        $leilaoDao->method('recuperarFinalizados')->willReturn([$this->fiat147, $this->variant]);
        $leilaoDao->expects($this->exactly(2))->method('atualiza')->withConsecutive([$this->fiat147], [$this->variant]);

        $this->email = $this->createMock(EnviadorEmail::class);
        
        $this->encerrador = new Encerrador($leilaoDao, $this->email);       
    }
    public function testLeiloesComMaisDeUmaSemanaDevemSerEncerrados() 
    {
        $this->encerrador->encerra();
        
        $leiloes = [$this->fiat147, $this->variant];
        self::assertCount(2, $leiloes);
        self::assertEquals('Fiat 147 0KM', $leiloes[0]->recuperarDescricao());
        self::assertEquals('Variant 1972 0KM', $leiloes[1]->recuperarDescricao());
        //self::assertEquals('Fiat 147 0KM', $leiloes[0]->estaFinalizado());
        //self::assertEquals('Variant 1972 0KM', $leiloes[1]->estaFinalizado());
    }
    
    public function testProcessoEncerramentoDeveContinuarMesmoComErroDeEmail()
    {
        $e = new \DomainException("Email não enviado");
        $this->email->expects($this->exactly(2))
            ->method('notificarTerminoLeilao')
            ->withConsecutive([$this->fiat147], [$this->variant])
            ->willThrowException($e);
        $this->encerrador->encerra();
        
    }
    
    public function testSoDeveEnviarLeilaoPorEmailAposFinalizado()
    {
        $this->email->expects($this->exactly(2))
            ->method('notificarTerminoLeilao')            
            ->willReturnCallback(function (Leilao $leilao) { // teste nos parâmetros da função acima, para testes mais complexos
                static::assertTrue($leilao->estaFinalizado()); 
            }
            //->with('teste') // sempre com esse argumento
            //->with($this->greaterThan(1)) // argumento maior que 1
            //->with($this->equalTo(1)) // argumento igual que 1
            //->with($this->lessThanOrEqual(1)) // argumento menor igual que 1
        );
            
        $this->encerrador->encerra(); 
    }
}
