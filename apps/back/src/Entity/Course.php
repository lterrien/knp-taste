<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $uuid;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $link;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    private User $author;

    public function __construct(Uuid $uuid, string $name, string $link, User $author)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->link = $link;
        $this->author = $author;
        $this->createdAt = new DateTimeImmutable();
    }
}
