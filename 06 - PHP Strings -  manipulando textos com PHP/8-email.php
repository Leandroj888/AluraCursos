<?php

$string = <<<FINAL
uMA lINHA
outra linha
etc
FINAL;

echo $string;
echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;



function geraEmail(): void
{
    $nome = "Leandro Junges";
    // FINAL é um identificador do programador define o importante é o <<<
    // não usa identação do código e acressenta os enters
    // Heredoc ->  <<<FINAL texto qualquer FINAL; => "" | nowdoc -> <<<'FINAL' texto qualquer FINAL; => ''
    $conteudoEmail = <<<FINAL

    Olá $nome

    Estamos entrando em contato para
    {motivo}

    {assinatura}';

    FINAL;

    echo $conteudoEmail;
}

geraEmail();

echo PHP_EOL;
echo '-------------------------------------------------' . PHP_EOL;