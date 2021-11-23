<?php

namespace App\Repository;

use App\Entity\SitterSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SitterSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitterSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitterSkill[]    findAll()
 * @method SitterSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitterSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitterSkill::class);
    }

    // /**
    //  * @return SitterSkill[] Returns an array of SitterSkill objects
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
    public function findOneBySomeField($value): ?SitterSkill
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
