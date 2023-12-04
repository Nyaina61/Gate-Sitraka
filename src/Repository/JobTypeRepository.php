<?php

namespace App\Repository;

use App\Entity\JobType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobType>
 *
 * @method JobType|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobType|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobType[]    findAll()
 * @method JobType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobType::class);
    }

//    /**
//     * @return JobType[] Returns an array of JobType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobType
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
