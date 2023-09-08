<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Factory\CourseFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class CourseFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly CourseFactory $courseFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        /**
         * Get admin users data from User fixtures
         *
         * @var User $admin1
         * @var User $admin2
         */
        $admin1 = $this->getReference('user1');
        $admin2 = $this->getReference('user2');

        /* Create 20 courses */
        foreach(range(1, 20) as $i) {
            $course = $this->courseFactory->getCourseInstance(
                'Course ' . $i,
                'link' . $i,
                $i % 2 ? $admin1 : $admin2
            );

            // Set custom created at date
            try {
                $course->setCreatedAt(new DateTimeImmutable('-' . $i . 'days'));
            } catch (Exception) {
                // If error, keep default created date already set in $course
            }

            $manager->persist($course);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
          UserFixtures::class
        ];
    }
}
