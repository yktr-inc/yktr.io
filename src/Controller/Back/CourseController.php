<?php

namespace App\Controller\Back;

use App\Entity\Course;
use App\Form\CourseType;
use App\Form\CourseClassroomType;
use App\Repository\CourseRepository;
use App\Repository\ClassroomRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    /**
     * @Route("/school/course/", name="course_index", methods={"GET"})
     */
    public function index(CourseRepository $courseRepository): Response
    {
        return $this->render('Back/course/index.html.twig', [
            'courses' => $courseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/school/course/new", name="course_new", methods={"GET","POST"})
     * @Route("/school/classroom/{id}/newCourse", name="classroom_course_new", methods={"GET","POST"})
     */
    public function new(Request $request, ClassroomRepository $classroomRepository, UserRepository $userRepository): Response
    {
        $course = new Course();

        $this->denyAccessUnlessGranted('create', $course);

        $classroomId = $request->attributes->get('id');

        if ($request->attributes->get('id')) {
            $form = $this->createForm(CourseClassroomType::class, $course);
            $classroom = $classroomRepository->findOneById($classroomId);
            $course->setClassroom($classroom);
        } else {
            $form = $this->createForm(CourseType::class, $course);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('course_index');
        }

        return $this->render('Back/course/new.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
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
    public function edit(Request $request, Course $course): Response
    {
        $this->denyAccessUnlessGranted('edit', $course);

        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('course_index', [
                'id' => $course->getId(),
            ]);
        }

        return $this->render('Back/course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/course/{id}", name="course_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Course $course): Response
    {
        $this->denyAccessUnlessGranted('delete', $course);

        if ($this->isCsrfTokenValid('delete'.$course->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($course);
            $entityManager->flush();
        }

        return $this->redirectToRoute('course_index');
    }
}
