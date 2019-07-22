<?php

namespace spec\App\Entity;

use App\Entity\Grade;
use PhpSpec\ObjectBehavior;

class GradeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Grade::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_user_setter()
    {
        $this->setUser(new \App\Entity\User());
    }

    public function it_has_a_user()
    {
        $value = new \App\Entity\User();
        $this->setUser($value);
        $this->getUser()->shouldReturn($value);
    }
    public function it_has_a_value_setter()
    {
        $this->setValue(10.2);
    }

    public function it_has_a_value()
    {
        $value = 10.2;
        $this->setValue($value);
        $this->getValue()->shouldReturn($value);
    }
    public function it_has_a_coefficient_setter()
    {
        $this->setCoefficient(10);
    }

    public function it_has_a_coefficient()
    {
        $value = 10;
        $this->setCoefficient($value);
        $this->getCoefficient()->shouldReturn($value);
    }
    public function it_has_a_type_setter()
    {
        $this->setType('awesome_string');
    }

    public function it_has_a_type()
    {
        $value = 'awesome_string';
        $this->setType($value);
        $this->getType()->shouldReturn($value);
    }
}
