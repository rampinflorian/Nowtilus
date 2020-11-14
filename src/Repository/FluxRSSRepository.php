<?php

namespace App\Repository;

use App\Entity\FluxRSS;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FluxRSS|null find($id, $lockMode = null, $lockVersion = null)
 * @method FluxRSS|null findOneBy(array $criteria, array $orderBy = null)
 * @method FluxRSS[]    findAll()
 * @method FluxRSS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method findByUser(object|\Symfony\Component\Security\Core\User\UserInterface|null $getUser)
 */
class FluxRSSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FluxRSS::class);
    }

    // /**
    //  * @return FluxRSS[] Returns an array of FluxRSS objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FluxRSS
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByUserIsActive(User $user)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.user = :val')
            ->andWhere('f.isActive = :val2')
            ->setParameter('val', $user)
            ->setParameter('val2', true)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
