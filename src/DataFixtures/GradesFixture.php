<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Grade;

class GradesFixture extends Fixture implements DependentFixtureInterface
{
    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    public function load(ObjectManager $manager)
    {
        $user = $this->userRepository->findOneBy(['id'=>random_int(1, 10)]);
        $course = $this->courseRepository->findOneBy(['id'=>1]);

        $grade1 = new Grade();
        $grade1->setUser($user);
        $grade1->setCourse($course);
        $grade1->setValue(random_int(0, 20));
        $grade1->setCoefficient(random_int(1, 4));
        $grade1->setType('cc1');
        $manager->persist($grade1);

        $grade2 = new Grade();
        $grade2->setUser($user);
        $grade2->setCourse($course);
        $grade2->setValue(random_int(0, 20));
        $grade2->setCoefficient(random_int(1, 4));
        $grade2->setType('cc2');
        $manager->persist($grade2);

        $grade3 = new Grade();
        $grade3->setUser($user);
        $grade3->setCourse($course);
        $grade3->setValue(random_int(0, 20));
        $grade3->setCoefficient(random_int(1, 4));
        $grade3->setType('exam');
        $manager->persist($grade3);

        $course = $this->courseRepository->findOneBy(['id'=>2]);

        $grade1 = new Grade();
        $grade1->setUser($user);
        $grade1->setCourse($course);
        $grade1->setValue(random_int(0, 20));
        $grade1->setCoefficient(random_int(1, 4));
        $grade1->setType('cc1');
        $manager->persist($grade1);

        $grade2 = new Grade();
        $grade2->setUser($user);
        $grade2->setCourse($course);
        $grade2->setValue(random_int(0, 20));
        $grade2->setCoefficient(random_int(1, 4));
        $grade2->setType('cc2');
        $manager->persist($grade2);

        $grade3 = new Grade();
        $grade3->setUser($user);
        $grade3->setCourse($course);
        $grade3->setValue(random_int(0, 20));
        $grade3->setCoefficient(random_int(1, 4));
        $grade3->setType('exam');
        $manager->persist($grade3);

        $course = $this->courseRepository->findOneBy(['id'=>3]);

        $grade1 = new Grade();
        $grade1->setUser($user);
        $grade1->setCourse($course);
        $grade1->setValue(random_int(0, 20));
        $grade1->setCoefficient(random_int(1, 4));
        $grade1->setType('cc1');
        $manager->persist($grade1);

        $grade2 = new Grade();
        $grade2->setUser($user);
        $grade2->setCourse($course);
        $grade2->setValue(random_int(0, 20));
        $grade2->setCoefficient(random_int(1, 4));
        $grade2->setType('cc2');
        $manager->persist($grade2);

        $grade3 = new Grade();
        $grade3->setUser($user);
        $grade3->setCourse($course);
        $grade3->setValue(random_int(0, 20));
        $grade3->setCoefficient(random_int(1, 4));
        $grade3->setType('exam');
        $manager->persist($grade3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CourseFixtures::class,
        );
    }
}
