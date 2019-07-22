<?php

namespace spec\App\Entity;

use App\Entity\File;
use PhpSpec\ObjectBehavior;

class FileSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(File::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_original_name_setter()
    {
        $this->setOriginalName('awesome_string');
    }

    public function it_has_a_original_name()
    {
        $value = 'awesome_string';
        $this->setOriginalName($value);
        $this->getOriginalName()->shouldReturn($value);
    }
}
