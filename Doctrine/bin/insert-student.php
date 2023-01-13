<?php

use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__.'/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();

//$student = new Student($argv[1]);

/*
$phone1 = new Phone('(21) 999999 - 9999');
$phone2 = new Phone('(21) 2222222 - 222');
$entityManager->persist($phone1);
$entityManager->persist($phone2);

$student = new Student("Aluno com telefone");
$student->addPhone($phone1);
$student->addPhone($phone2);
*/

/*
$student = new Student("Aluno com telefone2");
$student->addPhone(new Phone('(21) 999999 - 9999'));
$student->addPhone(new Phone('(21) 2222222 - 222'));
*/

$student = new Student($argv[1]);

for ($count = 2; $count<$argc; $count++) {
	$student->addPhone(new Phone($argv[$count]));
}

$entityManager->persist($student); // diz o que é pra armazenar
$entityManager->flush(); //por padrão só aqui será comitado todos persist

