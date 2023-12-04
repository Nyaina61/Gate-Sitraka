<?php

namespace App\Repository;

use App\Entity\Seal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seal>
 *
 * @method Seal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seal[]    findAll()
 * @method Seal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seal::class);
    }

//    /**
//     * @return Seal[] Returns an array of Seal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Seal
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
