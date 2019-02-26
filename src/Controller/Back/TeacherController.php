<?php

namespace App\Controller\Back;

use App\Entity\Course;
use App\Entity\Exam;
use App\Form\CourseType;
use App\Form\ExamType;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher/courses", name="teacher_course_index", methods={"GET"})
     */
    public function courseIndex(CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findByTeacher($this->getUser());
        return $this->render('Back/course/student/index.html.twig', [
            'courses' => $courses,
        ]);
    }

    /**
     * @Route("/teacher/course/{id}", name="teacher_course_show", methods={"GET"})
     */
    public function showCourse(Request $request, Course $course, CourseRepository $courseRepository): Response
    {
        return $this->render('Back/course/student/show.html.twig', [
            'course' => $course,
            'grades' => []
        ]);
    }

    /**
     * @Route("/teacher/exam/{id}", name="teacher_exam_show", methods={"GET"})
     */
    public function showExam(Exam $exam): Response
    {
        return $this->render('Back/exam/teacher/show.html.twig', [
            'exam' => $exam,
            'course' => $exam->getCourse()
        ]);
    }

    /**
     * @Route("/teacher/exam/{id}/edit", name="teacher_exam_edit", methods={"GET","POST"})
     */
    public function editExam(Request $request, Exam $exam): Response
    {
        $form = $this->createForm(ExamType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_exam_show', [
                'id' => $exam->getId(),
            ]);
        }

        return $this->render('Back/exam/teacher/edit.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
            'course' => $exam->getCourse()
        ]);
    }

    /**
     * @Route("/teacher/exam/{id}", name="teacher_exam_delete", methods={"DELETE"})
     */
    public function deleteExam(Request $request, Exam $exam): Response
    {
        $course = $exam->getCourse()->getId();

        if ($this->isCsrfTokenValid('delete'.$exam->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('teacher_course_show', ['id' => $course]);
    }
}
