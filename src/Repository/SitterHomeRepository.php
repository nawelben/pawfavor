<?php

namespace App\Repository;

use App\Entity\SitterHome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SitterHome|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitterHome|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitterHome[]    findAll()
 * @method SitterHome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitterHomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitterHome::class);
    }

    // /**
    //  * @return SitterHome[] Returns an array of SitterHome objects
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
    public function findOneBySomeField($value): ?SitterHome
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
