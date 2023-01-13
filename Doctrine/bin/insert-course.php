<?php

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__.'/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();

$course = new Course($argv[1]);

$entityManager->persist($course); // diz o que é pra armazenar
$entityManager->flush(); //por padrão só aqui será comitado todos persist


//$student = new Student('Vinicius');
//
//$student->enrollInCourse($course);
//
//$student->listCourses();
//$course->listStudents();