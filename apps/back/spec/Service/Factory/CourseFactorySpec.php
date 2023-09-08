<?php

namespace spec\App\Service\Factory;

use App\Entity\Course;
use App\Entity\User;
use App\Service\Factory\CourseFactory;
use App\Service\Uuid\UuidService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Uid\Uuid;

class CourseFactorySpec extends ObjectBehavior
{
    function let(UuidService $uuidService): void
    {
        $this->beConstructedWith($uuidService);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(CourseFactory::class);
    }

    function it_creates_course_instance_with_uuid(UuidService $uuidService): void
    {
        $name = 'name';
        $link = 'link';
        $author = new User(
            new Uuid('550e8400-e29b-41d4-a716-446655440000'),
            'test@test.com',
            'username'
        );

        /* Mock uuid generation */
        $uuid = new Uuid('550e8400-e29b-41d4-a716-446655440000');
        $uuidService->generateUuid()->willReturn($uuid);

        $course = $this->getCourseInstance($name, $link, $author);

        $course->shouldBeAnInstanceOf(Course::class);
        $course->getUuid()->shouldBe($uuid);
        $course->getName()->shouldBe($name);
        $course->getLink()->shouldBe($link);
        $course->getAuthor()->shouldBeAnInstanceOf(User::class);
    }
}
