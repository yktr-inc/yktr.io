<?php

namespace App\Repository;

use App\Entity\Exam;
use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * @method Exam|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exam|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exam[]    findAll()
 * @method Exam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exam::class);
    }

    // /**
    //  * @return Exam[] Returns an array of Exam objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exam
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findLastExams($limit, Classroom $classroom)
    {
        $em = $this->getEntityManager();

        $rsm = new ResultSetMappingBuilder($em);

        $rsm->addRootEntityFromClassMetadata(Exam::class, 'e');

        $query = $em->createNativeQuery(
            "
            SELECT e.* FROM exam e
            JOIN course co ON e.course_id = co.id
            JOIN classroom cl ON co.classroom_id = cl.id
            WHERE cl.id = :classroom
            ORDER BY e.date DESC
            LIMIT ".$limit,
            $rsm
        );

        $query->setParameter('classroom', $classroom);

        return $query->getResult();
    }
}
