<?php

namespace App\Repository;

use App\Entity\WarcraftProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WarcraftProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method WarcraftProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method WarcraftProfile[]    findAll()
 * @method WarcraftProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarcraftProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WarcraftProfile::class);
    }

    // /**
    //  * @return WarcraftProfile[] Returns an array of WarcraftProfile objects
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
    public function findOneBySomeField($value): ?WarcraftProfile
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
