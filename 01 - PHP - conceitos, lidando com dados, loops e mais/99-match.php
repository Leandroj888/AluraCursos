<?php
//https://floating-point-gui.de/

abstract class question {}
class Single extends question {}
class Multiple extends question {}



$input = "multi";

/*
switch ($input) {
    case "single":
        $question = new Single();
        break;
    case "multi":
        $question = new Multiple();
        break;
    default:
        throw new Exception("Invalid question type");
}
*/

$question = match ($input) {
    "single" => new Single(),
    "multi" , "multiple" => new Multiple(),
    default => throw new Exception("Invalid question type") // Não é obrigatório
};

var_dump($question);