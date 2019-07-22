<?php

namespace App\Controller\Back;

use App\Entity\Course;
use App\Entity\Exam;
use App\Form\ExamType;
use App\Repository\CourseRepository;
use App\Repository\ExamRepository;
use App\Service\DBNotificationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ExamController extends AbstractController
{
    /**
     * @Route("/school/exam/", name="exam_index", methods={"GET"})
     */
    public function index(ExamRepository $examRepository): Response
    {
        return $this->render('Back/exam/index.html.twig', [
            'exams' => $examRepository->findAll(),
        ]);
    }

    /**
     * @Route("/school/exam/new", name="exam_new", methods={"GET","POST"})
     * @Route("/teacher/course/{id}/exam/new", name="teacher_exam_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        CourseRepository $courseRepository,
        DBNotificationServiceInterface $notifService
    ): Response {
        $routeName = $request->get('_route');
        $courseId = $request->attributes->get('id');


        if ($routeName === 'teacher_exam_new') {
            $course = $courseRepository->findOneById($courseId);
            if ($course->getTeacher() !== $this->getUser()) {
                return new AccessDeniedException('Not the owner of the ressource.');
            }
        }

        $exam = new Exam();
        $form = $this->createForm(ExamType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($routeName === 'teacher_exam_new') {
                $exam->setCourse($course);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exam);
            $entityManager->flush();
            $recipients = $exam->getCourse()->getClassroom()->getUsers();
            $courseName = $exam->getCourse()->getTitle();

            $notifService->notify(
                "EXAM",
                $recipients,
                "New exam for ".$courseName,
                $exam->getId()
            );

            if ($routeName === 'exam_new') {
                return $this->redirectToRoute('exam_index');
            } else {
                return $this->redirectToRoute('teacher_course_show', ['id' => $course->getId()]);
            }
        }

        return $this->render('Back/exam/new.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
            'course' => isset($course) ? $course : null
        ]);
    }

    /**
     * @Route("/school/exam/{id}", name="exam_show", methods={"GET"})
     */
    public function show(Exam $exam): Response
    {
        return $this->render('Back/exam/show.html.twig', [
            'exam' => $exam,
        ]);
    }

    /**
     * @Route("/school/exam/{id}/edit", name="exam_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exam $exam): Response
    {
        $crud = $this->editAction($exam);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/exam/{id}", name="exam_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Exam $exam): Response
    {
        $this->deleteAction($exam);
        return $this->redirectToRoute('exam_index');
    }
}
