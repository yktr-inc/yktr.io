<?php

namespace spec\App\Entity;

use App\Entity\Notification;
use PhpSpec\ObjectBehavior;

class NotificationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Notification::class);
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
    public function it_has_a_link_setter()
    {
        $this->setLink('awesome_string');
    }

    public function it_has_a_link()
    {
        $value = 'awesome_string';
        $this->setLink($value);
        $this->getLink()->shouldReturn($value);
    }
    public function it_has_a_viewed_setter()
    {
        $this->setViewed(10);
    }

    public function it_has_a_viewed()
    {
        $value = 10;
        $this->setViewed($value);
        $this->getViewed()->shouldReturn($value);
    }
}
