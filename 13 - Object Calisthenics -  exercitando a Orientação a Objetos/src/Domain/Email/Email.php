<?php

namespace Alura\Calisthenics\Domain\Email;

class Email
{
    private string $email;
    
    public function __constructor(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
        
        $this->email = $email;
    }
    
    public function __toString(): string
    {
        return $this->email;
    }
}
