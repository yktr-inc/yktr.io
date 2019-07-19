<?php

namespace spec\App\Entity;

use App\Entity\Attendance;
use PhpSpec\ObjectBehavior;

class AttendanceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Attendance::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
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
}
