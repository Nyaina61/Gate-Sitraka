<?php

namespace App\Repository;

use App\Entity\PaysDemog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysDemog>
 *
 * @method PaysDemog|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysDemog|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysDemog[]    findAll()
 * @method PaysDemog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysDemogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysDemog::class);
    }

//    /**
//     * @return PaysDemog[] Returns an array of PaysDemog objects
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

//    public function findOneBySomeField($value): ?PaysDemog
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
