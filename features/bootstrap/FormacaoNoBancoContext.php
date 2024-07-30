<?php

use Alura\Armazenamento\Entity\Formacao;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class FormacaoNoBancoContext implements Context
{
    private EntityManagerInterface $em;

    private ?Formacao $formacaoInserida;

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
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        $this->em = (new \Alura\Armazenamento\Infra\EntitymanagerCreator())->getEntityManager();
    }

    /**
     * @When eu tentar criar uma nova formacao com a descricao :arg1
     */
    public function euTentarCriarUmaNovaFormacaoComADescricao(string $descricao)
    {
        $formacao = new Formacao();
        $formacao->setDescricao($descricao);

        $this->em->persist($formacao);
        $this->em->flush();

        $this->formacaoInserida = $formacao;
    }

    /**
     * @Then se eu buscar no banco, devo encontrar essa formacao
     */
    public function seEuBuscarNoBancoDevoEncontrarEssaFormacao()
    {
        /** @var Doctrine\ORM\EntityRepository<Formacao> */
        $formacoesRepository = $this->em->getRepository(Formacao::class);

        /** @var \Alura\Armazenamento\Entity\Formacao|null */
        $formacao = $formacoesRepository->find($this->formacaoInserida->getId());

        assert($formacao->getDescricao() === $this->formacaoInserida->getDescricao());
        assert($formacao instanceof Formacao);
    }
}
