<?php

namespace spec\App\Entity;

use App\Entity\Promotion;
use PhpSpec\ObjectBehavior;

class PromotionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Promotion::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_year_setter()
    {
        $this->setYear('awesome_string');
    }

    public function it_has_a_year()
    {
        $value = 'awesome_string';
        $this->setYear($value);
        $this->getYear()->shouldReturn($value);
    }
    public function it_has_a_code_setter()
    {
        $this->setCode('awesome_string');
    }

    public function it_has_a_code()
    {
        $value = 'awesome_string';
        $this->setCode($value);
        $this->getCode()->shouldReturn($value);
    }
    public function it_has_a_speciality_setter()
    {
        $this->setSpeciality('awesome_string');
    }

    public function it_has_a_speciality()
    {
        $value = 'awesome_string';
        $this->setSpeciality($value);
        $this->getSpeciality()->shouldReturn($value);
    }
    public function it_has_a_started_at_setter()
    {
        $this->setStartedAt(new \DateTime());
    }

    public function it_has_a_started_at()
    {
        $value = new \DateTime();
        $this->setStartedAt($value);
        $this->getStartedAt()->shouldReturn($value);
    }
    public function it_has_a_finished_at_setter()
    {
        $this->setFinishedAt(new \DateTime());
    }

    public function it_has_a_finished_at()
    {
        $value = new \DateTime();
        $this->setFinishedAt($value);
        $this->getFinishedAt()->shouldReturn($value);
    }
    public function it_has_a_classrooms_setter()
    {
        $this->addClassroom(new \App\Entity\Classroom());
        $this->removeClassroom(new \App\Entity\Classroom());
    }

    public function it_has_a_classrooms()
    {
        $value = new \App\Entity\Classroom();
        $this->addClassroom($value);
        $this->getClassrooms()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
}
