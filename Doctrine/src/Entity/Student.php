<?php

namespace Alura\Doctrine\Entity;

use Alura\Doctrine\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[Id, GeneratedValue, Column]
    public int $id;

    /**
     * FECH
     *    LAZY - BUSCA SÓ SE NECESSÁRIO - IDEAL (PADRÃO)
     *    EAGER - SEMPRE BUSCA
     */

    //OneToMany quem será one deve mapped quem for Many vai ser inversed
    #[OneToMany(
        targetEntity: Phone::class,
        mappedBy: "student",
        cascade:["persist","remove"],
        fetch: 'EAGER'
    )]
    public Collection $phones;

    //ManyToMany não importa quem será mapped ou inversed
    #[ManyToMany(Course::class, inversedBy: "students")]
	public Collection $courses;

    public function __construct(
        #[Column]
        public readonly string $name
    ){
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function addPhone(Phone $phone):void
    {
        $this->phones->add($phone);
        $phone->setStudent($this);

    }

    /**
     * @return Collection<Phone>
     */
    public function listPhone(): Collection
    {
        return $this->phones;
    }

	/**
	 * @return Collection<Course>
	 */
	public function listCourses():Collection
	{
		return $this->courses;
	}

	public function enrollInCourse(Course $course): void
	{
        if($this->courses->contains($course)){
            return;
        }
        $this->courses->add($course);
        $course->addStudent($this);
	}
}



