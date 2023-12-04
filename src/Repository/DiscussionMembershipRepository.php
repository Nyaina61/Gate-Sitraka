<?php

namespace App\Repository;

use App\Entity\DiscussionMembership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiscussionMembership>
 *
 * @method DiscussionMembership|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscussionMembership|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscussionMembership[]    findAll()
 * @method DiscussionMembership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscussionMembershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscussionMembership::class);
    }

//    /**
//     * @return DiscussionMembership[] Returns an array of DiscussionMembership objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DiscussionMembership
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
