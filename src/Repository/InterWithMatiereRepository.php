<?php

namespace App\Repository;

use App\Entity\InterWithMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InterWithMatiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterWithMatiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterWithMatiere[]    findAll()
 * @method InterWithMatiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterWithMatiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InterWithMatiere::class);
    }

    // /**
    //  * @return InterWithMatiere[] Returns an array of InterWithMatiere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InterWithMatiere
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
