<?php

namespace App\Repository;

use App\Entity\WaterQuality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WaterQuality|null find($id, $lockMode = null, $lockVersion = null)
 * @method WaterQuality|null findOneBy(array $criteria, array $orderBy = null)
 * @method WaterQuality[]    findAll()
 * @method WaterQuality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaterQualityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WaterQuality::class);
    }

    // /**
    //  * @return WaterQuality[] Returns an array of WaterQuality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WaterQuality
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
