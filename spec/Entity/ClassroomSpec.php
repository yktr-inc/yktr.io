<?php

namespace spec\App\Entity;

use App\Entity\Classroom;
use PhpSpec\ObjectBehavior;

class ClassroomSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Classroom::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
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
    public function it_has_a_promotion_setter()
    {
        $this->setPromotion(new \App\Entity\Promotion());
    }

    public function it_has_a_promotion()
    {
        $value = new \App\Entity\Promotion();
        $this->setPromotion($value);
        $this->getPromotion()->shouldReturn($value);
    }
    public function it_has_a_users_setter()
    {
        $this->addUser(new \App\Entity\User());
        $this->removeUser(new \App\Entity\User());
    }

    public function it_has_a_users()
    {
        $value = new \App\Entity\User();
        $this->addUser($value);
        $this->getUsers()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
    public function it_has_a_courses_setter()
    {
        $this->addCourse(new \App\Entity\Course());
        $this->removeCourse(new \App\Entity\Course());
    }

    public function it_has_a_courses()
    {
        $value = new \App\Entity\Course();
        $this->addCourse($value);
        $this->getCourses()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
}
