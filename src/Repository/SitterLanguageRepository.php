<?php

namespace App\Repository;

use App\Entity\SitterLanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SitterLanguage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitterLanguage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitterLanguage[]    findAll()
 * @method SitterLanguage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitterLanguageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitterLanguage::class);
    }

    // /**
    //  * @return SitterLanguage[] Returns an array of SitterLanguage objects
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
    public function findOneBySomeField($value): ?SitterLanguage
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
