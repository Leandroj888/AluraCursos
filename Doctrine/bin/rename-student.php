<?php

use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__.'/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();

/** @var Student $student */
$student = $entityManager->find(Student::class, $argv[1]);
$student->name = $argv[2];

$entityManager->flush();
