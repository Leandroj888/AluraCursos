<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;

class InMemoryVideoRepository implements VideoRepository
{
    private VideoList $videos;
    
    public function __construct()
    {
        $this->videos = new VideoList();
    }

    public function add(Video $video): self
    {
        $this->videos->add($video);
        
        return $this;
    }

    public function videosFor(Student $student): array
    {
        $today = new \DateTimeImmutable();
        return array_filter($this->videos->get(), fn (Video $video) => $video->getAgeLimit() <= $student->age());
        /*
        $today = new \DateTimeImmutable();
        return array_filter($this->videos->get(), fn (Video $video) => $video->getAgeLimit() <= $student->getBd()->diff($today)->y);
        */
    }
}
