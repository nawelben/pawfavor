<?php

namespace App\Repository;

use App\Entity\SitterServicePrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SitterServicePrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitterServicePrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitterServicePrice[]    findAll()
 * @method SitterServicePrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitterServicePriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitterServicePrice::class);
    }

    // /**
    //  * @return SitterServicePrice[] Returns an array of SitterServicePrice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SitterServicePrice
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
