<?php

namespace App\Repository;

use App\Entity\ProjectGroup;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method ProjectGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectGroup[]    findAll()
 * @method ProjectGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectGroup::class);
    }

    // /**
    //  * @return ProjectGroup[] Returns an array of ProjectGroup objects
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
    public function findOneBySomeField($value): ?ProjectGroup
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findUserProjectGroup(Project $project, User $user)
    {
        $em = $this->getEntityManager();

        $rsm = new ResultSetMappingBuilder($em);

        $rsm->addRootEntityFromClassMetadata(ProjectGroup::class, 'pg');

        $query = $em->createNativeQuery(
            "SELECT * FROM project_group pg
            LEFT JOIN users_groups ug ON pg.id = ug.group_id
            WHERE ug.user_id = :user
            AND pg.project_id = :project",
        $rsm
        );

        $query->setParameter('user', $user);
        $query->setParameter('project', $project);
        $res =  $query->getResult();
        if(isset($res[0])){
            return $res[0];
        }
        return $res;
    }
}
