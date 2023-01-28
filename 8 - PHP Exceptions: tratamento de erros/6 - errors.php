<?php
//========================= NUNCA FAZER ==========================\\

//PHP 8 não funciona o @
//echo @CONSTAN . PHP_EOL; // @ operador de supressão de erros


//========================= O QUE FAZER ==========================\\

// criar o seu gerenciador de erro
set_error_handler(function ($tipo, $mensagem, $arquivo, $linha){
    //var_dump($tipo, $mensagem, $arquivo, $linha);
    switch ($tipo) {
        case E_WARNING:
            echo "Aviso: Isto é perigoso" . PHP_EOL;
            break;
        case E_NOTICE:
            echo "Melhor não fazer isso" . PHP_EOL;
            break;
        case E_ERROR: // dá erro fatal mas n chama ele
            echo "ERRO algo está errado" . PHP_EOL;
            break;
    }
    return true;
});


echo $e[12] . PHP_EOL;

echo C . PHP_EOL;