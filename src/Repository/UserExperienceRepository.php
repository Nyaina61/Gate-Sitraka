<?php

namespace App\Repository;

use App\Entity\UserExperience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserExperience>
 *
 * @method UserExperience|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserExperience|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserExperience[]    findAll()
 * @method UserExperience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserExperience::class);
    }

//    /**
//     * @return UserExperience[] Returns an array of UserExperience objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserExperience
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
