<?php

namespace App\Repository;

use App\Entity\TrajetMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrajetMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrajetMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrajetMission[]    findAll()
 * @method TrajetMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrajetMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrajetMission::class);
    }

    // /**
    //  * @return TrajetMission[] Returns an array of TrajetMission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrajetMission
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
