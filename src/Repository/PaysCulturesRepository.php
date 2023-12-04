<?php

namespace App\Repository;

use App\Entity\PaysCultures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysCultures>
 *
 * @method PaysCultures|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysCultures|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysCultures[]    findAll()
 * @method PaysCultures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysCulturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysCultures::class);
    }

//    /**
//     * @return PaysCultures[] Returns an array of PaysCultures objects
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

//    public function findOneBySomeField($value): ?PaysCultures
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
