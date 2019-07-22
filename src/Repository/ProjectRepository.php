<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\User;
use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Project::class);
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
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
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findLastProjects($limit, $type, Classroom $classroom)
    {
        $em = $this->getEntityManager();

        $rsm = new ResultSetMappingBuilder($em);

        $rsm->addRootEntityFromClassMetadata(Project::class, 'p');

        $query = $em->createNativeQuery(
            "
            SELECT p.* FROM project p
            JOIN course co ON p.course_id = co.id
            JOIN classroom cl ON co.classroom_id = cl.id
            WHERE cl.id = :classroom
            AND p.type = :type
            ORDER BY p.updated_at DESC
            LIMIT ".$limit,
            $rsm
        );

        $query->setParameter('classroom', $classroom);
        $query->setParameter('type', $type);

        return $query->getResult();
    }

    public function findClassroomProjects($type, Classroom $classroom)
    {
        $em = $this->getEntityManager();

        $rsm = new ResultSetMappingBuilder($em);

        $rsm->addRootEntityFromClassMetadata(Project::class, 'p');

        $query = $em->createNativeQuery(
            "
            SELECT p.* FROM project p
            JOIN course co ON p.course_id = co.id
            JOIN classroom cl ON co.classroom_id = cl.id
            WHERE cl.id = :classroom
            AND p.type = :type
            ORDER BY p.updated_at DESC",
            $rsm
        );

        $query->setParameter('classroom', $classroom);
        $query->setParameter('type', $type);

        return $query->getResult();
    }

    public function findByTeacher($type, User $teacher)
    {
        $em = $this->getEntityManager();

        $rsm = new ResultSetMappingBuilder($em);

        $rsm->addRootEntityFromClassMetadata(Project::class, 'p');

        $query = $em->createNativeQuery(
            "
            SELECT p.* FROM project p
            JOIN course co ON p.course_id = co.id
            WHERE co.user_id = :user
            AND p.type = :type",
            $rsm
        );

        $query->setParameter('user', $teacher);
        $query->setParameter('type', $type);

        return $query->getResult();
    }
}
