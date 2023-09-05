<?php

namespace App\Repository;

use App\Entity\CourseUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CourseUser>
 *
 * @method CourseUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseUser[]    findAll()
 * @method CourseUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseUser::class);
    }
}
