<?php

namespace App\Repository;

use App\Entity\PaysPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysPost>
 *
 * @method PaysPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysPost[]    findAll()
 * @method PaysPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysPost::class);
    }

//    /**
//     * @return PaysPost[] Returns an array of PaysPost objects
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

//    public function findOneBySomeField($value): ?PaysPost
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
