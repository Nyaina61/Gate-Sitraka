<?php

namespace App\Repository;

use App\Entity\Thumbnail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Thumbnail>
 *
 * @method Thumbnail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thumbnail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thumbnail[]    findAll()
 * @method Thumbnail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThumbnailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thumbnail::class);
    }

//    /**
//     * @return Thumbnail[] Returns an array of Thumbnail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Thumbnail
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
