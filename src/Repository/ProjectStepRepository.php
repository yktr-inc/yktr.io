<?php

namespace App\Repository;

use App\Entity\ProjectStep;
use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method ProjectStep|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectStep|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectStep[]    findAll()
 * @method ProjectStep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectStepRepository  extends ServiceEntityRepository
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

    public function findLastProjectsSteps($limit, $type, Classroom $classroom)
    {
        $em = $this->getEntityManager();

        $rsm = new ResultSetMappingBuilder($em);

        $rsm->addRootEntityFromClassMetadata(ProjectStep::class, 'p');

        $query = $em->createNativeQuery(
            "SELECT ps.* FROM project_step ps
            JOIN project p ON ps.project_id = p.id
            JOIN course c ON p.course_id = c.id
            JOIN classroom cl ON c.classroom_id = cl.id
            WHERE p.type = :type
            AND cl.id = :classroom
            ORDER BY ps.end_at ASC
            LIMIT ".$limit ,$rsm );

        $query->setParameter('classroom', $classroom);
        $query->setParameter('type', $type);

        return $query->getResult();
    }
}
