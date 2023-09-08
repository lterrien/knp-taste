<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'author_uuid', referencedColumnName: 'uuid', nullable: false)]
    private User $author;

    public function __construct(Uuid $uuid, string $name, string $link, User $author)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->link = $link;
        $this->author = $author;
        $this->createdAt = new DateTimeImmutable();
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
