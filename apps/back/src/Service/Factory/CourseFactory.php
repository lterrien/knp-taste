<?php

namespace App\Service\Factory;

use App\Entity\Course;
use App\Entity\User;
use App\Service\Uuid\UuidService;

class CourseFactory
{
    public function __construct(private readonly UuidService $uuidService)
    {
    }

    public function getCourseInstance(string $name, string $link, User $author): Course
    {
        return new Course(
            $this->uuidService->generateUuid(),
            $name,
            $link,
            $author
        );
    }
}
