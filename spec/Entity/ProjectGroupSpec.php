<?php

namespace spec\App\Entity;

use App\Entity\ProjectGroup;
use PhpSpec\ObjectBehavior;

class ProjectGroupSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ProjectGroup::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_project_setter()
    {
        $this->setProject(new \App\Entity\Project());
    }

    public function it_has_a_project()
    {
        $value = new \App\Entity\Project();
        $this->setProject($value);
        $this->getProject()->shouldReturn($value);
    }
    public function it_has_a_students_setter()
    {
        $this->addStudent(new \App\Entity\User());
        $this->removeStudent(new \App\Entity\User());
    }

    public function it_has_a_students()
    {
        $value = new \App\Entity\User();
        $this->addStudent($value);
        $this->getStudents()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
}
