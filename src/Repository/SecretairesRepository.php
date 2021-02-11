<?php

namespace App\Repository;

use App\Entity\Secretaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Secretaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secretaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secretaires[]    findAll()
 * @method Secretaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecretairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secretaires::class);
    }

    // /**
    //  * @return Secretaires[] Returns an array of Secretaires objects
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
    public function findOneBySomeField($value): ?Secretaires
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
