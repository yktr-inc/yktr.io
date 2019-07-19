<?php

namespace spec\App\Entity;

use App\Entity\Course;
use PhpSpec\ObjectBehavior;

class CourseSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Course::class);
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
    public function it_has_a_teacher_setter()
    {
        $this->setTeacher(new \App\Entity\User());
    }

    public function it_has_a_teacher()
    {
        $value = new \App\Entity\User();
        $this->setTeacher($value);
        $this->getTeacher()->shouldReturn($value);
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
    public function it_has_a_exams_setter()
    {
        $this->addExam(new \App\Entity\Exam());
        $this->removeExam(new \App\Entity\Exam());
    }

    public function it_has_a_exams()
    {
        $value = new \App\Entity\Exam();
        $this->addExam($value);
        $this->getExams()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
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
    public function it_has_a_projects_setter()
    {
        $this->addProject(new \App\Entity\Project());
        $this->removeProject(new \App\Entity\Project());
    }

    public function it_has_a_projects()
    {
        $value = new \App\Entity\Project();
        $this->addProject($value);
        $this->getProjects()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }
}
