<?php

namespace App\Repository;

use App\Entity\PaysGouvernment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysGouvernment>
 *
 * @method PaysGouvernment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysGouvernment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysGouvernment[]    findAll()
 * @method PaysGouvernment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysGouvernmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysGouvernment::class);
    }

//    /**
//     * @return PaysGouvernment[] Returns an array of PaysGouvernment objects
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

//    public function findOneBySomeField($value): ?PaysGouvernment
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
