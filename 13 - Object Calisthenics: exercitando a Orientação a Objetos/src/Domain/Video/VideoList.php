<?php

namespace Alura\Calisthenics\Domain\Video;

class VideoList
{
    private array $videos;
    
    public function add(Video $video): self
    {
        $this->videos[] = $video;
        
        return $this;
    }
    
    public function get(): array
    {
        return $this->videos;
    }
}
