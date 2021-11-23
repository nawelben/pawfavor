<?php

namespace App\Repository;

use App\Entity\SitterAbout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SitterAbout|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitterAbout|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitterAbout[]    findAll()
 * @method SitterAbout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitterAboutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitterAbout::class);
    }

    // /**
    //  * @return SitterAbout[] Returns an array of SitterAbout objects
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
    public function findOneBySomeField($value): ?SitterAbout
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
