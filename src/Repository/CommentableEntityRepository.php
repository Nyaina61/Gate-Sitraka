<?php

namespace App\Repository;

use App\Entity\CommentableEntity;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<CommentableEntity>
 *
 * @method CommentableEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentableEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentableEntity[]    findAll()
 * @method CommentableEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentableEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentableEntity::class);
    }

//    /**
//     * @return CommentableEntity[] Returns an array of CommentableEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommentableEntity
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
