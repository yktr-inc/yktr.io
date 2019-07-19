<?php

namespace spec\App\Entity;

use App\Entity\Information;
use PhpSpec\ObjectBehavior;

class InformationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Information::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_title_setter()
    {
        $this->setTitle('awesome_string');
    }

    public function it_has_a_title()
    {
        $value = 'awesome_string';
        $this->setTitle($value);
        $this->getTitle()->shouldReturn($value);
    }
    public function it_has_a_content_setter()
    {
        $this->setContent('awesome_string');
    }

    public function it_has_a_content()
    {
        $value = 'awesome_string';
        $this->setContent($value);
        $this->getContent()->shouldReturn($value);
    }
}
