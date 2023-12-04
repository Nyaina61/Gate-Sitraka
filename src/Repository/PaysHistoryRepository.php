<?php

namespace App\Repository;

use App\Entity\PaysHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysHistory>
 *
 * @method PaysHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysHistory[]    findAll()
 * @method PaysHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysHistory::class);
    }

//    /**
//     * @return PaysHistory[] Returns an array of PaysHistory objects
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

//    public function findOneBySomeField($value): ?PaysHistory
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
