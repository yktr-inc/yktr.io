<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $encodedPassword = $this->encoder->encodePassword($user,$faker->password);

            $user->setUsername($faker->userName);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setEmail($faker->safeEmail);
            $user->setPassword($encodedPassword);
            $user->setRoles(array('ROLE_STUDENT'));

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

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user,'yktr');

        $user->setUsername('student');
        $user->setLastname('Chabert');
        $user->setFirstname('Dimitri');
        $user->setEmail('student@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_STUDENT'));

        $manager->persist($user);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user,'yktr');

        $user->setUsername('admin');
        $user->setLastname('Brother');
        $user->setFirstname('Big');
        $user->setEmail('admin@yktr.io');
        $user->setPassword($encodedPassword);
        $user->setRoles(array('ROLE_SUPERADMIN'));

        $manager->persist($user);

        $manager->flush();
    }
}
