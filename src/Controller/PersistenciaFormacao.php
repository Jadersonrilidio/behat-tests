<?php

namespace Alura\Armazenamento\Controller;

use Alura\Armazenamento\Entity\Formacao;
use Alura\Armazenamento\Helper\MensagemFlash;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaFormacao implements RequestHandlerInterface
{
    use MensagemFlash;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = new Formacao();

        try {
            $formacao->setDescricao($request->getParsedBody()['descricao']);
        } catch (\InvalidArgumentException $err) {
            $this->adicionaMensagemFlash('danger', $err->getMessage());
            return new Response(302, ['Location' => '/listar-formacoes']);
        }

        if (array_key_exists('id', $request->getQueryParams())) {
            $formacao->setId($request->getQueryParams()['id']);
            $this->entityManager->merge($formacao);
            $this->adicionaMensagemFlash('success', 'Formacao atualizada com sucesso');
        } else {
            $this->entityManager->persist($formacao);
            $this->adicionaMensagemFlash('success', 'Formacao cadastrada com sucesso');
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/listar-formacoes']);
    }
}
