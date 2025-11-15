<?php

$variavel = 'teste';
var_dump($variavel ); 
/**
 * Modo Normal
 *    string(5) "teste"
 * 
 *  Modo Xdebug
 *     /sda5/code/AluraCursos/15 - XDebug: ferramenta de debug e profiling/teste.php:4:string 'teste' (length=5)
 */
echo '<br><br>';

$variavel = 12;
var_dump($variavel );  
/**
 * Modo Normal
 *    int(12)
 * 
 *  Modo Xdebug
 *     /sda5/code/AluraCursos/15 - XDebug: ferramenta de debug e profiling/teste.php:15:int 12
 */
echo '<br><br>';

$variavel = 1213456465465431324654;  
var_dump($variavel );
/**
 * Modo Normal
 *    float(1.2134564654654313E+21)
 * 
 *  Modo Xdebug
 *     /sda5/code/AluraCursos/15 - XDebug: ferramenta de debug e profiling/teste.php:26:float 1.2134564654654E+21
 */
echo '<br><br>';

$variavel = true;
var_dump($variavel );  
/**
 * Modo Normal
 *    bool(true)
 * 
 *  Modo Xdebug
 *     /sda5/code/AluraCursos/15 - XDebug: ferramenta de debug e profiling/teste.php:37:boolean true
 */
echo '<br><br>';




require '2-outro.php';

try {
funcao1('parâmetro');
} catch (\Throwable $e) {
    echo '<br><br>';
    echo $e->getMessage();
}



