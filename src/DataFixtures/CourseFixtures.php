<?php

namespace App\DataFixtures;

use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Course;
use App\Repository\ClassroomRepository;

class CourseFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(UserRepository $userRepository, ClassroomRepository $classroomRepository)
    {
        $this->userRepository = $userRepository;
        $this->classroomRepository = $classroomRepository;
    }

    public function load(ObjectManager $manager)
    {
        $classroom = $this->classroomRepository->findOneBy(['name'=>'Classe IW1']);
        $teacher = $this->userRepository->findOneBy(['username'=>'mandrieu']);

        $faker = Faker\Factory::create('fr_FR');

        $course = new Course();
        $course->setStatus('on-going');
        $course->setClassroom($classroom);
        $course->setTeacher($teacher);
        $course->setTitle('Projet Annuel');
        $course->setDescription($faker->realText(800));
        $manager->persist($course);

        $teacher = $this->userRepository->findOneBy(['username'=>'amorin']);

        $course = new Course();
        $course->setStatus('on-going');
        $course->setClassroom($classroom);
        $course->setTeacher($teacher);
        $course->setTitle('Symfony');
        $course->setDescription($faker->realText(800));
        $manager->persist($course);

        $course = new Course();
        $course->setStatus('on-going');
        $course->setClassroom($classroom);
        $course->setTeacher($teacher);
        $course->setTitle('PHP avancé');
        $course->setDescription($faker->realText(800));
        $manager->persist($course);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ClassroomFixture::class,
        );
    }
}
