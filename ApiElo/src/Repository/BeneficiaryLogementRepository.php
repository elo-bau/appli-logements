<?php

namespace App\Repository;

use App\Entity\BeneficiaryLogement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BeneficiaryLogement|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeneficiaryLogement|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeneficiaryLogement[]    findAll()
 * @method BeneficiaryLogement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficiaryLogementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BeneficiaryLogement::class);
    }

    // /**
    //  * @return BeneficiaryLogement[] Returns an array of BeneficiaryLogement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BeneficiaryLogement
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
