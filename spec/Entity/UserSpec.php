<?php

namespace spec\App\Entity;

use App\Entity\User;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    public function it_has_an_id_getter()
    {
        $this->getId()->shouldBeNull();
    }

    public function it_has_a_username_setter()
    {
        $this->setUsername('awesome_string');
    }

    public function it_has_a_username()
    {
        $value = 'awesome_string';
        $this->setUsername($value);
        $this->getUsername()->shouldReturn($value);
    }
    public function it_has_a_email_setter()
    {
        $this->setEmail('awesome_string');
    }

    public function it_has_a_email()
    {
        $value = 'awesome_string';
        $this->setEmail($value);
        $this->getEmail()->shouldReturn($value);
    }
    public function it_has_a_phone_setter()
    {
        $this->setPhone('awesome_string');
    }

    public function it_has_a_phone()
    {
        $value = 'awesome_string';
        $this->setPhone($value);
        $this->getPhone()->shouldReturn($value);
    }
    public function it_has_a_password_setter()
    {
        $this->setPassword('awesome_string');
    }

    public function it_has_a_password()
    {
        $value = 'awesome_string';
        $this->setPassword($value);
        $this->getPassword()->shouldReturn($value);
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
    public function it_has_a_birthdate_setter()
    {
        $this->setBirthdate(new \DateTime());
    }

    public function it_has_a_birthdate()
    {
        $value = new \DateTime();
        $this->setBirthdate($value);
        $this->getBirthdate()->shouldReturn($value);
    }
    public function it_has_a_status_setter()
    {
        $this->setStatus('awesome_string');
    }

    public function it_has_a_status()
    {
        $value = 'awesome_string';
        $this->setStatus($value);
        $this->getStatus()->shouldReturn($value);
    }
    public function it_has_a_taught_courses_setter()
    {
        $this->addTaughtCourse(new \App\Entity\Course());
        $this->removeTaughtCourse(new \App\Entity\Course());
    }

    public function it_has_a_taught_courses()
    {
        $value = new \App\Entity\Course();
        $this->addTaughtCourse($value);
        $this->getTaughtCourses()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
    public function it_has_a_attendances_setter()
    {
        $this->addAttendance(new \App\Entity\Attendance());
        $this->removeAttendance(new \App\Entity\Attendance());
    }

    public function it_has_a_attendances()
    {
        $value = new \App\Entity\Attendance();
        $this->addAttendance($value);
        $this->getAttendances()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
    public function it_has_a_grades_setter()
    {
        $this->addGrade(new \App\Entity\Grade());
        $this->removeGrade(new \App\Entity\Grade());
    }

    public function it_has_a_grades()
    {
        $value = new \App\Entity\Grade();
        $this->addGrade($value);
        $this->getGrades()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
    public function it_has_a_notifications_setter()
    {
        $this->addNotification(new \App\Entity\Notification());
        $this->removeNotification(new \App\Entity\Notification());
    }

    public function it_has_a_notifications()
    {
        $value = new \App\Entity\Notification();
        $this->addNotification($value);
        $this->getNotifications()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
    public function it_has_a_classroom_setter()
    {
        $this->setClassroom(new \App\Entity\Classroom());
    }

    public function it_has_a_classroom()
    {
        $value = new \App\Entity\Classroom();
        $this->setClassroom($value);
        $this->getClassroom()->shouldReturn($value);
    }
    public function it_has_a_number_setter()
    {
        $this->setNumber('awesome_string');
    }

    public function it_has_a_number()
    {
        $value = 'awesome_string';
        $this->setNumber($value);
        $this->getNumber()->shouldReturn($value);
    }
    public function it_has_a_street_name_setter()
    {
        $this->setStreetName('awesome_string');
    }

    public function it_has_a_street_name()
    {
        $value = 'awesome_string';
        $this->setStreetName($value);
        $this->getStreetName()->shouldReturn($value);
    }
    public function it_has_a_postal_code_setter()
    {
        $this->setPostalCode('awesome_string');
    }

    public function it_has_a_postal_code()
    {
        $value = 'awesome_string';
        $this->setPostalCode($value);
        $this->getPostalCode()->shouldReturn($value);
    }
    public function it_has_a_city_setter()
    {
        $this->setCity('awesome_string');
    }

    public function it_has_a_city()
    {
        $value = 'awesome_string';
        $this->setCity($value);
        $this->getCity()->shouldReturn($value);
    }
    public function it_has_a_roles_setter()
    {
        $this->setRoles(['ROLE_STUDENT']);
    }

    public function it_has_a_roles()
    {
        $value = ['ROLE_STUDENT'];
        $this->setRoles($value);
        $this->getRoles()->shouldReturn($value);
    }
    public function it_has_a_reset_token_setter()
    {
        $this->setResetToken('awesome_string');
    }

    public function it_has_a_reset_token()
    {
        $value = 'awesome_string';
        $this->setResetToken($value);
        $this->getResetToken()->shouldReturn($value);
    }
}
