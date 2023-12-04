<?php

namespace App\Repository;

use App\Entity\EvaluableEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EvaluableEntity>
 *
 * @method EvaluableEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvaluableEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvaluableEntity[]    findAll()
 * @method EvaluableEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluableEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvaluableEntity::class);
    }

//    /**
//     * @return EvaluableEntity[] Returns an array of EvaluableEntity objects
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

//    public function findOneBySomeField($value): ?EvaluableEntity
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
