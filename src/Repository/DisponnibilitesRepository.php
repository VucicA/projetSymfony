<?php

namespace App\Repository;

use App\Entity\Disponnibilites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Disponnibilites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disponnibilites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disponnibilites[]    findAll()
 * @method Disponnibilites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisponnibilitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disponnibilites::class);
    }

    // /**
    //  * @return Disponnibilites[] Returns an array of Disponnibilites objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Disponnibilites
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
