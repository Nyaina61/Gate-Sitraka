<?php

namespace App\Repository;

use App\Entity\Recommended;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recommended>
 *
 * @method Recommended|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recommended|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recommended[]    findAll()
 * @method Recommended[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommendedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recommended::class);
    }

//    /**
//     * @return Recommended[] Returns an array of Recommended objects
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

//    public function findOneBySomeField($value): ?Recommended
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
