<?php

namespace App\Repository;

use App\Entity\CompanyLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyLogo>
 *
 * @method CompanyLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyLogo[]    findAll()
 * @method CompanyLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyLogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyLogo::class);
    }

//    /**
//     * @return CompanyLogo[] Returns an array of CompanyLogo objects
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

//    public function findOneBySomeField($value): ?CompanyLogo
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
