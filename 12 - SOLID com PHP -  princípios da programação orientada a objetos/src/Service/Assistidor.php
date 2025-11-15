<?php

namespace Alura\Solid\Service;

use Alura\Solid\Interface\Assistivel;
//use Alura\Solid\Model\AluraMais;
//use Alura\Solid\Model\Curso;

class Assistidor
{

    public function assistir(Assistivel $conteudo)
    {
        $conteudo->assistir();
    }
    /*
    public function assisteCurso(Curso $curso)
    {
        foreach ($curso->recuperarVideos() as $video) {
            $video->assistir();
        }
    }

    public function assisteAluraMais(AluraMais $aluraMais)
    {
        $aluraMais->assistir();
    }
    */
}
