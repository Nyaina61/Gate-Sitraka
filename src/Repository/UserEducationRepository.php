<?php

namespace App\Repository;

use App\Entity\UserEducation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserEducation>
 *
 * @method UserEducation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEducation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEducation[]    findAll()
 * @method UserEducation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEducationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEducation::class);
    }

//    /**
//     * @return UserEducation[] Returns an array of UserEducation objects
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

//    public function findOneBySomeField($value): ?UserEducation
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
