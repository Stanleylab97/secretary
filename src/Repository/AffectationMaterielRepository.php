<?php

namespace App\Repository;

use App\Entity\AffectationMateriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AffectationMateriel|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffectationMateriel|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffectationMateriel[]    findAll()
 * @method AffectationMateriel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffectationMaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AffectationMateriel::class);
    }

    // /**
    //  * @return AffectationMateriel[] Returns an array of AffectationMateriel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AffectationMateriel
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
