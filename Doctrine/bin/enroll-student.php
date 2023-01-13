<?php


use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__.'/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();


$studentId = $argv[1];
$courseId = $argv[2];

/** @var Student $student */
$student = $entityManager->find(Student::class, $studentId);

/** @var Course $course */
$course = $entityManager->find(Course::class, $courseId);

$student->enrollInCourse($course);
$entityManager->flush();
