<?php

namespace App\Repository;

use App\Entity\PurchaseList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PurchaseList|null find($id, $lockMode = null, $lockVersion = null)
 * @method PurchaseList|null findOneBy(array $criteria, array $orderBy = null)
 * @method PurchaseList[]    findAll()
 * @method PurchaseList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PurchaseListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PurchaseList::class);
    }

    // /**
    //  * @return PurchaseList[] Returns an array of PurchaseList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PurchaseList
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
