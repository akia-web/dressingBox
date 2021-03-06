<?php

namespace App\Repository;

use App\Entity\Vetement2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

/**
 * @method Vetement2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vetement2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vetement2[]    findAll()
 * @method Vetement2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Vetement2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vetement2::class);
    }

    // public function_aleatoire(Connection $connection)
    // {
    //     $sql = "SELECT photo,id,categorie FROM Vetement2 WHERE categorie = 'bas' ORDER BY RAND();";
    //     $data = $connection->fetchAll($sql);
    //     return $data;
    // }




    // public function findByHaut()
    // {
    //     return $this->createQueryBuilder('v')
    //         ->andWhere('v.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('v.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    // */
    

    // /**
    //  * @return Vetement2[] Returns an array of Vetement2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vetement2
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}