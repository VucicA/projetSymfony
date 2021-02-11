<?php

namespace App\Repository;

use App\Entity\Alternants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alternants|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alternants|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alternants[]    findAll()
 * @method Alternants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlternantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alternants::class);
    }

    // /**
    //  * @return Alternants[] Returns an array of Alternants objects
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
    public function findOneBySomeField($value): ?Alternants
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
