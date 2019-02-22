<?php

namespace App\Controller\Back;

use App\Entity\Course;
use App\Entity\Exam;
use App\Entity\Project;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/courses", name="student_course_index", methods={"GET"})
     */
    public function courseIndex(CourseRepository $courseRepository): Response
    {
        $courses = $this->getUser()->getClassroom()->getCourses()->filter(
          function ($entry) {
              return $entry->getStatus() === 'ACTIVE';
          }
        );
        return $this->render('Back/course/student/index.html.twig', [
            'courses' => $courses,
        ]);
    }

    /**
     * @Route("/student/course/{id}", name="student_course_show", methods={"GET"})
     */
    public function courseShow(Request $request, Course $course, CourseRepository $courseRepository): Response
    {
        return $this->render('Back/course/student/show.html.twig', [
            'course' => $course,
            'grades' => []
        ]);
    }

    /**
     * @Route("/student/exam/{id}", name="student_exam_show", methods={"GET"})
     */
    public function showExam(Exam $exam): Response
    {
        return $this->render('Back/exam/student/show.html.twig', [
            'exam' => $exam,
            'course' => $exam->getCourse()
        ]);
    }

    /**
     * @Route("/student/project/{id}", name="student_project_show", methods={"GET"})
     */
    public function showProject(Project $project): Response
    {
        return $this->render('Back/project/student/show.html.twig', [
            'project' => $project,
            'course' => $project->getCourse()
        ]);
    }
}
