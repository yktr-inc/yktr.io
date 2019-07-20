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
        $classroom = $this->classroomRepository->findOneBy(['name'=>'Classroom 1']);
        $teacher = $this->userRepository->findOneBy(['username'=>'teacher']);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 4; $i++) {
            $course = new Course();

            $course->setStatus('on-going');
            $course->setClassroom($classroom);
            $course->setTeacher($teacher);
            $course->setTitle($faker->sentence(3));
            $course->setDescription($faker->text);

            $manager->persist($course);
        }

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
