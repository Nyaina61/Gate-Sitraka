<?php

namespace App\Repository;

use App\Entity\ImageEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageEntity>
 *
 * @method ImageEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageEntity[]    findAll()
 * @method ImageEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageEntity::class);
    }

//    /**
//     * @return ImageEntity[] Returns an array of ImageEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageEntity
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
