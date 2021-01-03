<?php

namespace App\Repository;

use App\Entity\AttributionVehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttributionVehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributionVehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributionVehicule[]    findAll()
 * @method AttributionVehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributionVehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributionVehicule::class);
    }

    // /**
    //  * @return AttributionVehicule[] Returns an array of AttributionVehicule objects
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
    public function findOneBySomeField($value): ?AttributionVehicule
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
