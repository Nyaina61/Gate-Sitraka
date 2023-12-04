<?php

namespace App\Repository;

use App\Entity\Religion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Religion>
 *
 * @method Religion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Religion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Religion[]    findAll()
 * @method Religion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReligionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Religion::class);
    }

//    /**
//     * @return Religion[] Returns an array of Religion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Religion
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
