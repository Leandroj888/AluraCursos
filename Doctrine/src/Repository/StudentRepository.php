<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Student;
use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
	protected $property;

	/**
	 * @return Student[]
	 */
	public function studentsWithCourses(): array
	{
		/*
		$studentClass = Student::class;
		$dql = "
			SELECT student, phone, course
			FROM $studentClass student
				LEFT JOIN student.phones phone
				LEFT JOIN student.courses course
		";
		return $this->getEntityManager()->createQuery($dql)->getResult();
		*/

		return $this->createQueryBuilder('student')
			->addSelect('phone')
			->addSelect('course')
			->leftJoin('student.phones', 'phone')
			->leftJoin('student.courses', 'course')
			->getQuery()
			->getResult();
	}
}
