<?php

namespace App\DataFixtures;

use App\Enum\UserRole;
use App\Service\Factory\UserFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const IS_ADMIN = 'isAdmin';
    const VIEWS_COUNT = 'viewsCount';
    const LAST_COURSE_VIEW_DATE = 'lastCourseViewDate';

    public function __construct(private readonly UserFactory $userFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        /* Get necessary data to create users (ex: is admin) */
        $courseUserData = self::getCourseUserData();
        $i = 1;

        /* Foreach user, create user data and persist it */
        foreach ($courseUserData as $userData) {

            $user = $this->userFactory->getUserInstance(
                'user' . $i . '@knplabs.com',
                'password' . $i,
                'user' . $i
            );

            // Add admin role if user is admin
            if($userData[self::IS_ADMIN]) {
                $user->addRole(UserRole::RoleAdmin);
            }

            // User data related to courses
            $user->setViewsCount($userData[self::VIEWS_COUNT]);
            $user->setLastCourseViewDate($userData[self::LAST_COURSE_VIEW_DATE]);

            $manager->persist($user);
            $i++;
        }

        $manager->flush();
    }

    /**
     * Get necessary data to create User instances
     * @return array
     */
    private static function getCourseUserData(): array
    {
        return [
            [
                self::IS_ADMIN => true,
                self::VIEWS_COUNT => 3,
                self::LAST_COURSE_VIEW_DATE => new DateTimeImmutable('yesterday')
            ],
            [
                self::IS_ADMIN  => true,
                self::VIEWS_COUNT => 15,
                self::LAST_COURSE_VIEW_DATE => new DateTimeImmutable('-10 days')
            ],
            [
                self::IS_ADMIN  => false,
                self::VIEWS_COUNT => 2,
                self::LAST_COURSE_VIEW_DATE => new DateTimeImmutable('today')
            ],
            [
                self::IS_ADMIN  => false,
                self::VIEWS_COUNT => 12,
                self::LAST_COURSE_VIEW_DATE => new DateTimeImmutable('-5 days')
            ],
            [
                self::IS_ADMIN  => false,
                self::VIEWS_COUNT => 10,
                self::LAST_COURSE_VIEW_DATE => new DateTimeImmutable('today')
            ]
        ];
    }
}
