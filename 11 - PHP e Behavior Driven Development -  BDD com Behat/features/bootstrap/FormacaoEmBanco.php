<?php

use Alura\Armazenamento\Entity\Formacao;
use Alura\Armazenamento\Infra\EntitymanagerCreator;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class FormacaoEmBanco implements Context
{
    private EntityManagerInterface $entityManager;
    private int $idFormacaoInserida = 0;

    /**
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        $this->entityManager = (new EntitymanagerCreator())->getEntityManager();
    }

    /**
     * @When tento salvar uma nova formação com a descrição :arg1
     */
    public function tentoSalvarUmaNovaFormacaoComADescricao(string $descricaoFormacao)
    {
        $formacao = new Formacao();
        $formacao->setDescricao($descricaoFormacao);
        
        $this->entityManager->persist($formacao);
        $this->entityManager->flush();
        
        $this->idFormacaoInserida = $formacao->getId();
    }

    /**
     * @Then se eu buscar no banco, devo encontrar essa formação
     */
    public function seEuBuscarNoBancoDevoEncontrarEssaFormacao()
    {
        /** @var \Doctrine\Persistence\ObjectRepository $repository */
        $repository = $this->entityManager->getRepository(Formacao::class);
        
        /** @var Formacao $formacao */
        $formacao = $repository->findBy(["id" => $this->idFormacaoInserida]);
        
        //esse assert é do próprio PHP e não do PHPUnit
        assert($formacao instanceof Formacao);
    }
}
