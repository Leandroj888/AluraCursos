<?php

//include '8-funcoes.php'; //Não encontro o arquivo só dá um aviso (arquivos não obrigatórios)
//require '8-funcoes.php'; //Não encontro o arquivo dá erro (arquivos obrigatórios)
require_once '8-funcoes.php'; //Não encontro o arquivo dá erro (arquivos obrigatórios) (só inclui se o arquivo ainda n foi inserido)

$contaCorrentes = [
    "123.456.789-10" => [
        "titular" => "Viní",
        "saldo" => 500
    ],
    "123.456.789-11" => [
        "titular" => "Maria",
        "saldo" => 10000
    ],
    "123.456.789-12" => [
        "titular" => "Albert",
        "saldo" => 300
    ]
];

$contaCorrentes["123.456.789-11"] = sacar($contaCorrentes["123.456.789-11"], 500);
$contaCorrentes["123.456.789-12"] = sacar($contaCorrentes["123.456.789-12"], 200);
$contaCorrentes["123.456.789-10"] = depositar($contaCorrentes["123.456.789-10"], 500);


unset($contaCorrentes["123.456.789-12"]); //remover váriavel da mémoria | unset pode receber várias váriaveis separadas por vírgula


titularMaiusculas($contaCorrentes["123.456.789-10"], 500);

//https://www.php.net/manual/en/language.types.string.php
foreach ($contaCorrentes as $cpf => $conta) {
    //exibeMensagem("CPF $cpf | Titular " . $conta["titular"] . "\t| Saldo "  . $conta["saldo"]);

    //exibeMensagem("CPF $cpf | Titular $conta[titular] \t| Saldo $conta[saldo]"); //forma simples


    //exibeMensagem("CPF $cpf | Titular {$conta["titular"]} \t| Saldo {$conta["saldo"]}"); //forma complexa

    //list("titular" => $titular, "saldo" => $saldo) = $conta; // PHP 7 atrás
    //["titular" => $titular, "saldo" => $saldo] = $conta; // PHP 7.1 pra mais
    //exibeMensagem("CPF $cpf | Titular $titular \t| Saldo $saldo");


    //exibeConta($conta);
}

?>

<!-- <?= $testee ?>  = <?php echo $testee; ?>   -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Contas correntes</h1>

    <dl>
        <?php foreach($contaCorrentes as $cpf => $conta) { ?>
            <dt>
                <h3><?= $conta['titular']; ?> - <?= $cpf; ?></h3>
            </dt>
            <dd>Saldo: <?= $conta['saldo']; ?></dd>
        <?php } ?>
    </ul>
</body>
</html>