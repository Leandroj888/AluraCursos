<?php

namespace Alura\Armazenamento\Controller;

use Alura\Armazenamento\Entity\Formacao;
use Alura\Armazenamento\Helper\MensagemFlash;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExclusaoDeFormacao implements RequestHandlerInterface
{
    use MensagemFlash;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = $this->entityManager->getReference(Formacao::class, $request->getQueryParams()['id']);
        $this->entityManager->remove($formacao);
        $this->entityManager->flush();
        $this->adicionaMensagemFlash('success', 'Formação excluída com sucesso');

        return new Response(302, ['Location' => '/listar-formacoes']);
    }
}
