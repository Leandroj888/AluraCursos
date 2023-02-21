<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Video\Video;
use DateTimeInterface;

class Student
{
    private Email $email;
    private DateTimeInterface $birthDate;
    private WatchedVideos $watchedVideos;
    private string $fullName;
    private string $lastName;
    public string $street;
    public string $number;
    public string $province;
    public string $city;
    public string $state;
    public string $country;

    public function __construct(Email $email, DateTimeInterface $birthDate, string $fullName, string $lastName, string $street, string $number, string $province, string $city, string $state, string $country)
    {
        $this->watchedVideos = new WatchedVideos();
        //$this->setEmail($email);
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->fullName = $fullName;
        $this->lastName = $lastName;
        $this->street = $street;
        $this->number = $number;
        $this->province = $province;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    public function fullName(): string
    {
        return "{$this->fullName} {$this->lastName}";
    }
    /*
    private function setEmail(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            $this->email = $email;
        } else {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
    }
    */
    public function email(): string
    {
        return $this->email;
    }

    public function birthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }
    
    public function age(): int
    {
        $today = new \DateTimeImmutable();
        $dateInterval = $this->birthDate->diff($today);
        return $dateInterval->y;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
        //$this->watchedVideos->put($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0) {
            return true;
        }
        
        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
        
        /*
        if ($this->watchedVideos->count() > 0) {
            $this->watchedVideos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
            /** @var DateTimeInterface $firstDate 
            $firstDate = $this->watchedVideos->first()->value;
            $today = new \DateTimeImmutable();

            if ($firstDate->diff($today)->days >= 90) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
        */
    }
    
    private function firstVideoWasWatchedInLessThan90Days()
    {
        
    }
}
