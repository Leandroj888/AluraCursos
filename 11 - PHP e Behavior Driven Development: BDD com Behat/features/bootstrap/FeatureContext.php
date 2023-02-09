<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When eu criar uma formação com a descrição :arg1
     */
    public function euCriarUmaFormacaoComADescricao($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then eu vou ver a seguinte mensagem de erro :arg1
     */
    public function euVouVerASeguinteMensagemDeErro($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        throw new PendingException();
    }

    /**
     * @When tento criar uma nova formação com a descrição :arg1
     */
    public function tentoCriarUmaNovaFormacaoComADescricao($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then se eu buscar no banco, devo encontrar essa formação
     */
    public function seEuBuscarNoBancoDevoEncontrarEssaFormacao()
    {
        throw new PendingException();
    }
}
