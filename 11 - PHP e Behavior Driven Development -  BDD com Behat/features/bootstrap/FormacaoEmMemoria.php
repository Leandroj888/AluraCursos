<?php

use Behat\Behat\Tester\Exception\PendingException;
use Alura\Armazenamento\Entity\Formacao;
use Behat\Behat\Context\Context;

class FormacaoEmMemoria implements Context
{    
    private string $mensagemDeErro = "";
    private Formacao $formacao;

    /**
     * @When eu criar uma formação com a descrição :arg1
     */
    public function euCriarUmaFormacaoComADescricao(string $descricaoFormacao)
    {
        try {
            $this->formacao = new Formacao();
            $this->formacao->setDescricao($descricaoFormacao);
        } catch (\InvalidArgumentException $exception) {
            $this->mensagemDeErro = $exception->getMessage();
        }
    }

    /**
     * @Then eu vou ver a seguinte mensagem de erro :arg1
     */
    public function euVouVerASeguinteMensagemDeErro(string $mensagemDeErro)
    {
        //esse assert é do próprio PHP e não do PHPUnit
        assert($mensagemDeErro === $this->mensagemDeErro);
    }

    /**
     * @Then eu vou ter uma formação criada com a descrição :arg1
     */
    public function euVouTerUmaFormacaoCriadaComADescricao(string $descricaoFormacao)
    {
        assert($descricaoFormacao === $this->formacao->getDescricao());
    }
}
