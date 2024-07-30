<?php

use Behat\Behat\Tester\Exception\PendingException;
use Alura\Armazenamento\Entity\Formacao;
use Behat\Behat\Context\Context;

class FormacaoEmMemoriaContext implements Context
{
    private string $errorMessage = '';

    private ?Formacao $formacaoCriada;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        //
    }

    /**
     * @When eu tentar criar uma formacao com a descricao :arg1
     */
    public function euTentarCriarUmaFormacaoComADescricao(string $descricao)
    {
        $this->formacaoCriada = new Formacao();

        try {
            $this->formacaoCriada->setDescricao($descricao);
        } catch (\InvalidArgumentException $e) {
            $this->errorMessage = $e->getMessage();
        }
    }

    /**
     * @Then eu vou ver a seguinte mensagem de erro :arg1
     */
    public function euVouVerASeguinteMensagemDeErro(string $errorMessage)
    {
        assert($this->errorMessage === $errorMessage);
    }

    /**
     * @Then eu devo ter uma formacao criada com a descricao :arg1
     */
    public function euDevoTerUmaFormacaoCriadaComADescricao(string $descricao)
    {
        assert($descricao === $this->formacaoCriada->getDescricao());
    }
}
