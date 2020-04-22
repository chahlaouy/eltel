<?php

namespace App\Repository;

use App\Entity\TypeNumero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeNumero|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNumero|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNumero[]    findAll()
 * @method TypeNumero[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNumeroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNumero::class);
    }

    // /**
    //  * @return TypeNumero[] Returns an array of TypeNumero objects
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
    public function findOneBySomeField($value): ?TypeNumero
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
