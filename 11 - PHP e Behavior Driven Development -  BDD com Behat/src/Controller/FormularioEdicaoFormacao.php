<?php

namespace Alura\Armazenamento\Controller;

use Alura\Armazenamento\Helper\HtmlViewTrait;
use Alura\Armazenamento\Entity\Formacao;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicaoFormacao implements RequestHandlerInterface
{
    use HtmlViewTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = $this->entityManager->find(Formacao::class, $request->getQueryParams()['id']);

        $titulo = 'Editar Formação';
        $html = $this->getHtmlFromTemplate('formacoes/formulario.php', compact('formacao', 'titulo'));

        return new Response(200, [], $html);
    }
}
