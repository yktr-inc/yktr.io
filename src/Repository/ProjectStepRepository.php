<?php

namespace App\Repository;

use App\Entity\ProjectStep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjectStep|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectStep|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectStep[]    findAll()
 * @method ProjectStep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectStepRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectStep::class);
    }

    // /**
    //  * @return ProjectStep[] Returns an array of ProjectStep objects
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
    public function findOneBySomeField($value): ?ProjectStep
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
