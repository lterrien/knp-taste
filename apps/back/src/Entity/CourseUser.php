<?php

namespace App\Entity;

use App\Repository\CourseUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseUserRepository::class)]
class CourseUser extends User
{
    #[ORM\Column(nullable: true)]
    private ?int $viewsCount = null;

    #[ORM\Column(nullable: true)]
    private ?int $lastView = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Course::class)]
    private Collection $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): static
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->setAuthor($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        if ($this->courses->removeElement($course)) {
            // set the owning side to null (unless already changed)
            if ($course->getAuthor() === $this) {
                $course->setAuthor(null);
            }
        }

        return $this;
    }
}
