<?php

namespace Alura\Armazenamento\Controller;

use Alura\Armazenamento\Entity\Formacao;
use Alura\Armazenamento\Helper\HtmlViewTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class FormularioInsercaoFormacao implements RequestHandlerInterface
{
    use HtmlViewTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        //
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = new Formacao();
        $titulo = 'Cadastrar Formacao';
        $html = $this->getHtmlFromTemplate('formacoes/formulario.php', compact('formacao', 'titulo'));

        return new Response(200, [], $html);
    }
}
