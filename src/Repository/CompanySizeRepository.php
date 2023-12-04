<?php

namespace App\Repository;

use App\Entity\CompanySize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanySize>
 *
 * @method CompanySize|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanySize|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanySize[]    findAll()
 * @method CompanySize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanySizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanySize::class);
    }

//    /**
//     * @return CompanySize[] Returns an array of CompanySize objects
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

//    public function findOneBySomeField($value): ?CompanySize
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
