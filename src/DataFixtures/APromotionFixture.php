<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\Promotion;

class APromotionFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $promotion = new Promotion();

        $promotion->setYear('First year');
        $promotion->setCode('12019EA');
        $promotion->setSpeciality('Web');
        $promotion->setStartedAt(new \DateTime());
        $promotion->setFinishedAt(new \DateTime());
        $manager->persist($promotion);
        $manager->flush();

        $promotion->setYear('Second year');
        $promotion->setCode('329OZE');
        $promotion->setSpeciality('Web');
        $promotion->setStartedAt(new \DateTime());
        $promotion->setFinishedAt(new \DateTime());
        $manager->persist($promotion);
        $manager->flush();
    }
}
