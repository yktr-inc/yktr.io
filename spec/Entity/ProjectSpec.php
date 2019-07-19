<?php

namespace spec\App\Entity;

use App\Entity\Project;
use PhpSpec\ObjectBehavior;

class ProjectSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Project::class);
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
    public function it_has_a_groups_setter()
    {
        $this->addGroup(new \App\Entity\ProjectGroup());
        $this->removeGroup(new \App\Entity\ProjectGroup());
    }

    public function it_has_a_groups()
    {
        $value = new \App\Entity\ProjectGroup();
        $this->addGroup($value);
        $this->getGroups()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
}
