<?php

namespace Alura\Armazenamento\Controller;

use Alura\Armazenamento\Helper\HtmlViewTrait;
use Alura\Armazenamento\Entity\Formacao;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListaDeFormacoes implements RequestHandlerInterface
{
    use HtmlViewTrait;

    /** @var EntityRepository<Formacao> */
    private EntityRepository $formacoesRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->formacoesRepository = $entityManager->getRepository(Formacao::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacoes = $this->formacoesRepository->findBy($request->getQueryParams(), ['descricao' => 'ASC']);
        $titulo = 'Listagem de Formacoes';

        $html = $this->getHtmlFromTemplate('formacoes/listar.php', compact('formacoes', 'titulo'));

        return new Response(200, [], $html);
    }
}
