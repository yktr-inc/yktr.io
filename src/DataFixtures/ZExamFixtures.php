<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\Exam;
use App\Repository\ClassroomRepository;

class ZExamFixtures extends Fixture
{
    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    public function load(ObjectManager $manager)
    {
        $classroom = $this->classroomRepository->findOneBy(['name'=>'Classroom 1']);

        $exam = new Exam();

        $exam->setType('EXAM');
        $exam->setName('CC');
        $exam->setClassroom($classroom);
        $exam->setDate(new \Datetime('2019-03-18'));
        $manager->persist($exam);

        $manager->flush();
    }
}
