<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Setting;

class SettingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $setting = new Setting();
        $setting->setKey('sitename');
        $setting->setValue('my school');
        $manager->persist($setting);
        $manager->flush();
    }
}
