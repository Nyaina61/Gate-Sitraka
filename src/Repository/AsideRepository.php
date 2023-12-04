<?php

namespace App\Repository;

use App\Entity\Aside;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Aside>
 *
 * @method Aside|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aside|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aside[]    findAll()
 * @method Aside[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aside::class);
    }

//    /**
//     * @return Aside[] Returns an array of Aside objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Aside
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
