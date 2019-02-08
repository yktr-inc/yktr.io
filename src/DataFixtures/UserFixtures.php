<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\User;
use App\Repository\ClassroomRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder, ClassroomRepository $classroomRepository)
    {
        $this->encoder = $encoder;
        $this->classroomRepository = $classroomRepository;
    }

    public function load(ObjectManager $manager)
    {
        $classroom = $this->classroomRepository->findOneBy(['name'=>'Classroom 1']);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $encodedPassword = $this->encoder->encodePassword($user,$faker->password);

            $user->setUsername($faker->userName);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setEmail($faker->safeEmail);
            $user->setPassword($encodedPassword);
            $user->setRoles(array('ROLE_STUDENT'));
            $user->setClassroom($classroom);

            $manager->persist($user);
        }

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user,'yktr');

        $user->setUsername('administrative');
        $user->setLastname('Narvalo');
        $user->setFirstname('Maximilien');
        $user->setEmail('administrative@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_ADMINISTRATIVE'));
        $user->setClassroom($classroom);

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user,'yktr');

        $user->setUsername('student');
        $user->setLastname('Chabert');
        $user->setFirstname('Dimitri');
        $user->setEmail('student@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_STUDENT'));
        $user->setClassroom($classroom);

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user,'yktr');

        $user->setUsername('admin');
        $user->setLastname('Brother');
        $user->setFirstname('Big');
        $user->setEmail('admin@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_SUPERADMIN'));
        $user->setClassroom($classroom);

        $manager->persist($user);

        $manager->flush();
    }
}
