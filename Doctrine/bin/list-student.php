<?php

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__.'/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();
/**
 * FETCH EACH DE PHONE FUNCIONA AQUI MAS NO DQL PRECISA DECLARAR MANUALMENTE
 *$studentRepository = $entityManager->getRepository(Student::class);
 *$studentList = $studentRepository->findAll();
*/

/*
$studentClass = Student::class;
$dql = "
	SELECT student, phone, course
	FROM $studentClass student
		LEFT JOIN student.phones phone
		LEFT JOIN student.courses course
";
$studentList = $entityManager->createQuery($dql)->getResult();
*/

$studentRepository = $entityManager->getRepository(Student::class);
/** @var Student[] $studentList */
$studentList = $studentRepository->studentsWithCourses();

foreach ($studentList as $student) {
	echo $student->id . " - " . $student->name ."\n";

	if ($student->listPhone()->count() > 0) {
		echo "      Telefones: " . implode(', ',$student->listPhone()
			->map(fn (Phone $phone) => $phone->number)
			->toArray()) . PHP_EOL;
	}

	if ($student->listCourses()->count() > 0) {
		echo "      Cursos: " . implode(', ',$student->listCourses()
			->map(fn (Course $course) => $course->name)
			->toArray()) . PHP_EOL;
	}
	/*
	foreach($student->listPhone() as $phone) {
		echo "      Telefone: " . $phone->number . PHP_EOL;
	}
	*/
}

/**
echo "\n---------------------\n";
$student = $studentRepository->find(2);
echo $student->name;

echo "\n---------------------\n";
$student = $studentRepository->findBy(["name" => "Aluno Teste"]);
echo $student->name;
*/

echo "\n---------------------\n";

//echo $studentRepository->count([]);
//echo count($studentList);

$studentClass = Student::class;
//$dql = "SELECT COUNT(student) FROM $studentClass student WHERE SIZE(student.phones) = 1";
$dql = "SELECT COUNT(student) FROM $studentClass student";
echo $entityManager->createQuery($dql)->getSingleScalarResult();


echo "\n---------------------\n";



echo "\n---------- CACHE -----------\n";

//echo $studentRepository->count([]);
//echo count($studentList);

$studentClass = Student::class;
//$dql = "SELECT COUNT(student) FROM $studentClass student WHERE SIZE(student.phones) = 1";
$dql = "SELECT COUNT(student) FROM $studentClass student";
$query = $entityManager->createQuery($dql)->enableResultCache(86400); //em segundos
echo $query->getSingleScalarResult();


echo "\n---------------------\n" . PHP_EOL;
