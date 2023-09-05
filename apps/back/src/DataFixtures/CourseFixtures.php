<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        /* Get admin users data from CourseUser fixtures */
        /**
         * @var CourseUser $admin1
         * @var CourseUser $admin2
         */
        $admin1 = $this->getReference('user1');
        $admin2 = $this->getReference('user2');

        /* Create 20 courses */
        for($i = 1; $i <= 20; $i++) {
            $course = new Course();
            $course->setName('Course ' . $i);
            $course->setLink('link' . $i);
            $course->setCreatedAt(strtotime('-' . $i . 'days'));

            // Set a user admin as author
            if($i % 2 == 0) {
                $course->setAuthor($admin1);
            } else {
                $course->setAuthor($admin2);
            }

            $manager->persist($course);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
          CourseUserFixtures::class
        ];
    }
}
