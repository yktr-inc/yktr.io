<?php

namespace spec\App\Entity;

use App\Entity\Setting;
use PhpSpec\ObjectBehavior;

class SettingSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Setting::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_key_setter()
    {
        $this->setKey('awesome_string');
    }

    public function it_has_a_key()
    {
        $value = 'awesome_string';
        $this->setKey($value);
        $this->getKey()->shouldReturn($value);
    }
    public function it_has_a_value_setter()
    {
        $this->setValue('awesome_string');
    }

    public function it_has_a_value()
    {
        $value = 'awesome_string';
        $this->setValue($value);
        $this->getValue()->shouldReturn($value);
    }
}
