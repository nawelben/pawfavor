<?php

namespace App\Repository;

use App\Entity\OwnerAbout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OwnerAbout|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerAbout|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerAbout[]    findAll()
 * @method OwnerAbout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerAboutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OwnerAbout::class);
    }

    // /**
    //  * @return OwnerAbout[] Returns an array of OwnerAbout objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OwnerAbout
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
