<?php

namespace App\Repository;

use App\Entity\JobGrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobGrade>
 *
 * @method JobGrade|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobGrade|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobGrade[]    findAll()
 * @method JobGrade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobGradeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobGrade::class);
    }

//    /**
//     * @return JobGrade[] Returns an array of JobGrade objects
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

//    public function findOneBySomeField($value): ?JobGrade
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
