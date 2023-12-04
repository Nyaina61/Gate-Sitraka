<?php

namespace App\Repository;

use App\Entity\PaysEconomy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaysEconomy>
 *
 * @method PaysEconomy|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaysEconomy|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaysEconomy[]    findAll()
 * @method PaysEconomy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysEconomyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaysEconomy::class);
    }

//    /**
//     * @return PaysEconomy[] Returns an array of PaysEconomy objects
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

//    public function findOneBySomeField($value): ?PaysEconomy
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
