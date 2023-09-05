<?php

namespace App\DataFixtures;

use App\Entity\CourseUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /* Get necessary data to create users (ex: is admin) */
        $courseUserData = self::getCourseUserData();
        $i = 1;

        /* Foreach user, create user data and persist it */
        foreach ($courseUserData as $userData) {
            $user = new CourseUser();

            // User data related to security and profile
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@knplabs.com');
            $user->setPassword('password' . $i);

            // Define roles depending on if user is admin
            if($userData[0]) {
                $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }

            // User data related to courses
            $user->setViewsCount($userData[1]);
            $user->setLastView($userData[2]);

            $manager->persist($user);
            $i++;
        }

        $manager->flush();
    }

    /**
     * Get necessary data to create CourseUser instances
     * Data in array: isAdmin, viewsCount, lastView
     * @return array
     */
    private static function getCourseUserData(): array
    {
        return [
            [true, 3, strtotime('yesterday')],
            [true, 15, strtotime('-10 days')],
            [false, 2, strtotime('today')],
            [false, 12, strtotime('-5 days')],
            [false, 10, strtotime('today')]
        ];
    }
}
