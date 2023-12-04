<?php

namespace App\Repository;

use App\Entity\ProfilePicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfilePicture>
 *
 * @method ProfilePicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilePicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilePicture[]    findAll()
 * @method ProfilePicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilePictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilePicture::class);
    }

//    /**
//     * @return ProfilePicture[] Returns an array of ProfilePicture objects
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

//    public function findOneBySomeField($value): ?ProfilePicture
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
