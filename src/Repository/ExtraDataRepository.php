<?php

namespace App\Repository;

use App\Entity\ExtraData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExtraData>
 *
 * @method ExtraData|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtraData|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtraData[]    findAll()
 * @method ExtraData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtraDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExtraData::class);
    }

//    /**
//     * @return ExtraData[] Returns an array of ExtraData objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExtraData
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
