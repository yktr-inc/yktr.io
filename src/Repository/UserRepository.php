<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Paginator;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function all()
    {
        return $this
        ->createQueryBuilder('u')
        ->getQuery();
    }

    public function findByRole($role)
    {

        $rsm = new  ResultSetMapping();

        $role = "%'".$role."'%";
        $em = $this->getEntityManager();
        $query = $em->createNativeQuery("SELECT * FROM account WHERE roles::text LIKE :role", $rsm);
        $query->setParameter('role', $role);
        return $query->getResult();
    }

    public function allTeachers()
    {

    }

    public function allAdministratives()
    {

    }

    // public function allStudents()
    // {
    //     return $this->createQueryBuilder('p')
    //     ->
    // }



    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
