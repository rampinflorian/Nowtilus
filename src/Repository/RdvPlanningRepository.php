<?php

namespace App\Repository;

use App\Entity\RdvPlanning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RdvPlanning|null find($id, $lockMode = null, $lockVersion = null)
 * @method RdvPlanning|null findOneBy(array $criteria, array $orderBy = null)
 * @method RdvPlanning[]    findAll()
 * @method RdvPlanning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RdvPlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RdvPlanning::class);
    }

    // /**
    //  * @return RdvPlanning[] Returns an array of RdvPlanning objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RdvPlanning
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
