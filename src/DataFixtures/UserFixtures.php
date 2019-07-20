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

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $encodedPassword = $this->encoder->encodePassword($user, $faker->password);

            $user->setUsername($faker->userName);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setPhone($faker->phoneNumber);
            $user->setEmail($faker->safeEmail);
            $user->setPassword($encodedPassword);
            $user->setRoles(array('ROLE_STUDENT'));
            $user->setClassroom($classroom);

            $user->setNumber($faker->buildingNumber);
            $user->setStreetName($faker->streetName);
            $user->setPostalCode($faker->postcode);
            $user->setCity($faker->city);

            $manager->persist($user);
        }

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, 'yktr');

        $user->setUsername('hknorr');
        $user->setLastname('Hugo');
        $user->setFirstname('Knorr');
        $user->setPassword($faker->phoneNumber);
        $user->setPhone($faker->phoneNumber);
        $user->setEmail('hknorr@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_STUDENT'));
        $user->setClassroom($classroom);

        $user->setNumber($faker->buildingNumber);
        $user->setStreetName($faker->streetName);
        $user->setPostalCode($faker->postcode);
        $user->setCity($faker->city);

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, 'yktr');

        $user->setUsername('eleclerq');
        $user->setLastname('Leclerq');
        $user->setFirstname('Elena');
        $user->setPassword($faker->phoneNumber);
        $user->setPhone($faker->phoneNumber);
        $user->setEmail('eleclerq@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_ADMINISTRATIVE'));

        $user->setNumber($faker->buildingNumber);
        $user->setStreetName($faker->streetName);
        $user->setPostalCode($faker->postcode);
        $user->setCity($faker->city);

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, 'yktr');

        $user->setUsername('mandrieu');
        $user->setLastname('Andrieu');
        $user->setFirstname('Mickael');
        $user->setPassword($faker->phoneNumber);
        $user->setPhone($faker->phoneNumber);
        $user->setEmail('mandrieu@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_TEACHER'));

        $user->setNumber($faker->buildingNumber);
        $user->setStreetName($faker->streetName);
        $user->setPostalCode($faker->postcode);
        $user->setCity($faker->city);

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, 'yktr');

        $user->setUsername('amorin');
        $user->setLastname('Adrien');
        $user->setFirstname('Morin');
        $user->setPassword($faker->phoneNumber);
        $user->setPhone($faker->phoneNumber);
        $user->setEmail('amorin@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_TEACHER'));

        $user->setNumber($faker->buildingNumber);
        $user->setStreetName($faker->streetName);
        $user->setPostalCode($faker->postcode);
        $user->setCity($faker->city);

        $manager->persist($user);

        $manager->flush();
    }
}
