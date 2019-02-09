<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Classroom;
use App\Repository\PromotionRepository;

class ClassroomFixture extends Fixture
{

    public function __construct(PromotionRepository $promotionRepository){
      $this->promotionRepository = $promotionRepository;
    }

    public function load(ObjectManager $manager)
    {
<<<<<<< HEAD
        $promotion = $this->promotionRepository->findOneBy(['year'=>'First year']);
=======
        $promotion = $this->promotionRepository->findOneBy(['title'=>'First year']);
>>>>>>> Adding fixtures and last exams data for dashboard (#106)

        $classroom = new Classroom();

        $classroom->setName('Classroom 1');
        $classroom->setPromotion($promotion);
        $manager->persist($classroom);

        $manager->flush();
    }
}
