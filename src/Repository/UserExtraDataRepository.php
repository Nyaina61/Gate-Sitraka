<?php

namespace App\Repository;

use App\Entity\UserExtraData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserExtraData>
 *
 * @method UserExtraData|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserExtraData|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserExtraData[]    findAll()
 * @method UserExtraData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserExtraDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserExtraData::class);
    }

//    /**
//     * @return UserExtraData[] Returns an array of UserExtraData objects
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

//    public function findOneBySomeField($value): ?UserExtraData
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
