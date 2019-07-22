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
        $setting->setValue('Fabulous School');
        $setting->setLabel('School name');
        $manager->persist($setting);

        $setting = new Setting();
        $setting->setKey('start');
        $setting->setLabel('Start of the year');
        $setting->setValue('09');
        $manager->persist($setting);

        $manager->flush();
    }
}
