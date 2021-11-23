<?php

namespace App\Repository;

use App\Entity\SavedSitters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SavedSitters|null find($id, $lockMode = null, $lockVersion = null)
 * @method SavedSitters|null findOneBy(array $criteria, array $orderBy = null)
 * @method SavedSitters[]    findAll()
 * @method SavedSitters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SavedSittersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SavedSitters::class);
    }

    // /**
    //  * @return SavedSitters[] Returns an array of SavedSitters objects
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
    public function findOneBySomeField($value): ?SavedSitters
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
