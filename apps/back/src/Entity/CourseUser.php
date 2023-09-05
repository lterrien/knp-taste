<?php

namespace App\Entity;

use App\Repository\CourseUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseUserRepository::class)]
class CourseUser extends User
{
    #[ORM\Column(nullable: true)]
    private ?int $viewsCount = null;

    #[ORM\Column(nullable: true)]
    private ?int $lastView = null;

    public function getViewsCount(): ?int
    {
        return $this->viewsCount;
    }

    public function setViewsCount(?int $viewsCount): static
    {
        $this->viewsCount = $viewsCount;

        return $this;
    }

    public function getLastView(): ?int
    {
        return $this->lastView;
    }

    public function setLastView(?int $lastView): static
    {
        $this->lastView = $lastView;

        return $this;
    }
}
