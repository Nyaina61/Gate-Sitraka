<?php

namespace App\Repository;

use App\Entity\PaysFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysFiles>
 *
 * @method PaysFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysFiles[]    findAll()
 * @method PaysFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysFiles::class);
    }

//    /**
//     * @return PaysFiles[] Returns an array of PaysFiles objects
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

//    public function findOneBySomeField($value): ?PaysFiles
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
