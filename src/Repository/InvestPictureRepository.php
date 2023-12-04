<?php

namespace App\Repository;

use App\Entity\InvestPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InvestPicture>
 *
 * @method InvestPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvestPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvestPicture[]    findAll()
 * @method InvestPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvestPicture::class);
    }

//    /**
//     * @return InvestPicture[] Returns an array of InvestPicture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InvestPicture
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
