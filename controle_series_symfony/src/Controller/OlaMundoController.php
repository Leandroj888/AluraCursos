<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OlaMundoController extends AbstractController
{
    /*
    #[Route('/ola_mundo')]
    public function index(): Response
    {
        return new Response("<h1>Olá Mundo</h1>" . $_GET['id']);
    }
    */

    #[Route('/ola_mundo', methods:['GET'])]
    public function index(Request $request): Response
    {
        //dd($request->query->get('id')); //Parâmetros da url ?id=1
        //dd($request->request->get('id')); //Parâmetros do POST ou formulários
        //dd($request->attributes->get('id')); //Dados da rota
        //dd($request->get('id'));// tenta encontrar em algum lugar qualquer

        return new Response(
            "<h1>Olá Mundo</h1>" . $request->query->get('id'),
            401,
            [
                'X-Qualquer-Coisa' => 'Valor'
            ]
        );
    }
}
