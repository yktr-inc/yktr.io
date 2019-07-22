<?php

namespace spec\App\Entity;

use App\Entity\ProjectStep;
use PhpSpec\ObjectBehavior;

class ProjectStepSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ProjectStep::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_step_order_setter()
    {
        $this->setStepOrder('awesome_string');
    }

    public function it_has_a_step_order()
    {
        $value = 'awesome_string';
        $this->setStepOrder($value);
        $this->getStepOrder()->shouldReturn($value);
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
    public function it_has_a_end_at_setter()
    {
        $this->setEndAt(new \DateTime());
    }

    public function it_has_a_end_at()
    {
        $value = new \DateTime();
        $this->setEndAt($value);
        $this->getEndAt()->shouldReturn($value);
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
}
