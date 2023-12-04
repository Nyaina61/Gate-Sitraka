<?php

namespace App\Repository;

use App\Entity\UserCertificationsLicences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCertificationsLicences>
 *
 * @method UserCertificationsLicences|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCertificationsLicences|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCertificationsLicences[]    findAll()
 * @method UserCertificationsLicences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCertificationsLicencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCertificationsLicences::class);
    }

//    /**
//     * @return UserCertificationsLicences[] Returns an array of UserCertificationsLicences objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserCertificationsLicences
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
