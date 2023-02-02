<?php

namespace Alura\Leilao\Tests\Integration\Dao;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Infra\ConnectionCreator;
use Alura\Leilao\Model\Leilao;
use PDO;
use PHPUnit\Framework\TestCase;

class LeilaoDaoTest extends TestCase
{
    private static PDO $pdo;
    
    public static function setUpBeforeClass(): void
    {
        //$this->pdo = ConnectionCreator::getConnection();
        self::$pdo = new PDO('sqlite::memory:');
        self::$pdo->exec('CREATE TABLE leiloes (
            id INTEGER PRIMARY KEY, 
            descricao TEXT, 
            finalizado BOOL, 
            dataInicio TEXT
            );');        
    }
    
    protected function setUp(): void
    {
        self::$pdo->beginTransaction();
    }
    
    /**
     * @dataProvider leiloes
     */
    public function testBuscaLeiloesNaoFinalizados(array $leiloes)
    {
        //arrange
        $leilaoDao = new LeilaoDao(self::$pdo);
        foreach($leiloes as $leilao) {
            $leilaoDao->salva($leilao);
        }
                
        //act
        $leiloes = $leilaoDao->recuperarNaoFinalizados();

        //assert
        self::assertCount(1, $leiloes);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame(
            'Variant 0km', 
            $leiloes[0]->recuperarDescricao()
        );  
    }
    
    /**
     * @dataProvider leiloes
     */
    public function testBuscaLeiloesFinalizados(array $leiloes)
    {
        //arrange
        $leilaoDao = new LeilaoDao(self::$pdo);
        foreach($leiloes as $leilao) {
            $leilaoDao->salva($leilao);
        }
        
        //act
        $leiloes = $leilaoDao->recuperarFinalizados();

        //assert
        self::assertCount(1, $leiloes);
        self::assertContainsOnlyInstancesOf(Leilao::class, $leiloes);
        self::assertSame(
            'Fiat147 0km', 
            $leiloes[0]->recuperarDescricao()
        );  
    }
    
    public function leiloes()
    {
        $naoFinalizado = new Leilao('Variant 0km');
        
        $finalizado = new Leilao('Fiat147 0km');
        $finalizado->finaliza();
        
        return [[
            [$naoFinalizado, $finalizado ]
        ]];
    }
    
    protected function tearDown(): void
    {
        self::$pdo->rollBack();
    }
}
