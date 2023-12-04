<?php

namespace App\Repository;

use App\Entity\PaysGeography;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysGeography>
 *
 * @method PaysGeography|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysGeography|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysGeography[]    findAll()
 * @method PaysGeography[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysGeographyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysGeography::class);
    }

//    /**
//     * @return PaysGeography[] Returns an array of PaysGeography objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PaysGeography
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
