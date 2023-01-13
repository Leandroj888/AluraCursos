<?php

use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__.'/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();

/** @var Student $student */
//$student = $entityManager->getPartialReference(Student::class, $argv[1]);
$student = $entityManager->find(Student::class, $argv[1]); // Para delete cascade no SQL Lite têm que buscar tudo para outros banco pode ser o método da linha acima
$entityManager->remove($student);
$entityManager->flush();

$first = 1; //inicio do teste