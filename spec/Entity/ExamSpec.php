<?php

namespace spec\App\Entity;

use App\Entity\Exam;
use PhpSpec\ObjectBehavior;

class ExamSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Exam::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
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
    public function it_has_a_name_setter()
    {
        $this->setName('awesome_string');
    }

    public function it_has_a_name()
    {
        $value = 'awesome_string';
        $this->setName($value);
        $this->getName()->shouldReturn($value);
    }
    public function it_has_a_description_setter()
    {
        $this->setDescription('awesome_string');
    }

    public function it_has_a_description()
    {
        $value = 'awesome_string';
        $this->setDescription($value);
        $this->getDescription()->shouldReturn($value);
    }
    public function it_has_a_course_setter()
    {
        $this->setCourse(new \App\Entity\Course());
    }

    public function it_has_a_course()
    {
        $value = new \App\Entity\Course();
        $this->setCourse($value);
        $this->getCourse()->shouldReturn($value);
    }
    public function it_has_a_date_setter()
    {
        $this->setDate(new \DateTime());
    }

    public function it_has_a_date()
    {
        $value = new \DateTime();
        $this->setDate($value);
        $this->getDate()->shouldReturn($value);
    }
}
