<?php

namespace spec\App\Entity;

use App\Entity\Contact;
use PhpSpec\ObjectBehavior;

class ContactSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Contact::class);
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
    public function it_has_a_firstname_setter()
    {
        $this->setFirstname('awesome_string');
    }

    public function it_has_a_firstname()
    {
        $value = 'awesome_string';
        $this->setFirstname($value);
        $this->getFirstname()->shouldReturn($value);
    }
    public function it_has_a_lastname_setter()
    {
        $this->setLastname('awesome_string');
    }

    public function it_has_a_lastname()
    {
        $value = 'awesome_string';
        $this->setLastname($value);
        $this->getLastname()->shouldReturn($value);
    }
    public function it_has_a_cellphone_setter()
    {
        $this->setCellphone('awesome_string');
    }

    public function it_has_a_cellphone()
    {
        $value = 'awesome_string';
        $this->setCellphone($value);
        $this->getCellphone()->shouldReturn($value);
    }
    public function it_has_a_workphone_setter()
    {
        $this->setWorkphone('awesome_string');
    }

    public function it_has_a_workphone()
    {
        $value = 'awesome_string';
        $this->setWorkphone($value);
        $this->getWorkphone()->shouldReturn($value);
    }
}
