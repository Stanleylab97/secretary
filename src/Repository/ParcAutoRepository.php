<?php

namespace App\Repository;

use App\Entity\ParcAuto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParcAuto|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParcAuto|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParcAuto[]    findAll()
 * @method ParcAuto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcAutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParcAuto::class);
    }

    // /**
    //  * @return ParcAuto[] Returns an array of ParcAuto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParcAuto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
