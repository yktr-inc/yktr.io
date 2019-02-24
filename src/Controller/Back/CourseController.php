<?php

namespace App\Controller\Back;

use App\Entity\Course;
use App\Form\CourseType;
use App\Form\CourseClassroomType;
use App\Repository\CourseRepository;
use App\Repository\ClassroomRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;

class CourseController extends CRUDController
{
    /**
     * @Route("/school/course/", name="course_index", methods={"GET"})
     */
    public function index(CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findAll();

        $crud = $this->indexAction($courses, Course::class);

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/course/new", name="course_new", methods={"GET","POST"})
     * @Route("/school/classroom/{id}/newCourse", name="classroom_course_new", methods={"GET","POST"})
     */
    public function new(Request $request, ClassroomRepository $classroomRepository): Response
    {
        $course = new Course();
        $options = [];

        $this->denyAccessUnlessGranted('create', $course);

        $classroomId = $request->attributes->get('id');

        $formType = isset($classroomId) ? CourseClassroomType::class : CourseType::class;

        if (isset($classroomId)) {
            $classroom = $classroomRepository->findOneById($classroomId);
            $course->setClassroom($classroom);
            $options['obj'] = $course;
        }

        $crud = $this->newAction($course, $formType, $options);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/course/{id}", name="course_show", methods={"GET"})
     */
    public function show(Course $course): Response
    {
        return $this->render('Back/course/show.html.twig', [
            'course' => $course,
        ]);
    }

    /**
     * @Route("/school/course/{id}/edit", name="course_edit", methods={"GET","POST"})
     */
    public function edit(Course $course): Response
    {
        $this->denyAccessUnlessGranted('edit', $course);

        $crud = $this->editAction($course);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/course/{id}", name="course_delete", methods={"DELETE"})
     */
    public function delete(Course $course): Response
    {
        $this->denyAccessUnlessGranted('delete', $course);

        $this->deleteAction($course);

        return $this->redirectToRoute('course_index');
    }
}
