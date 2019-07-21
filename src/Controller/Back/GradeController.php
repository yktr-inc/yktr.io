<?php

namespace App\Controller\Back;

use App\Entity\Grade;
use App\Form\GradeType;
use App\Repository\CourseRepository;
use App\Repository\GradeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/grades")
 */
class GradeController extends AbstractController
{
    /**
     * @Route("/student", name="student_grade_index", methods={"GET"})
     */
    public function index(GradeRepository $gradeRepository): Response
    {
        $allGrades = $gradeRepository->findBy(['user' => $this->getUser()]);
        $gradesByCourse = [];
        $allCourses = [];
        foreach ($allGrades as $grade){
            if(!in_array($grade->getCourse()->getTitle(), $allCourses)){
                array_push($allCourses, $grade->getCourse()->getTitle());
            }
        }
        foreach ($allCourses as $c){
            $gradesForCourse = [];
            foreach ($allGrades as $grade){
                if($grade->getCourse()->getTitle() == $c){
                    $gradesForCourse[$grade->getType()] = ['val'=>$grade->getValue()];
                }
            }
            $gradesByCourse[$c] = $gradesForCourse;
        }

        return $this->render('Back/grade/student/index.html.twig', [
            'grades' => $gradesByCourse
        ]);
    }

    /**
     * @Route("/new", name="grade_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $grade = new Grade();
        $form = $this->createForm(GradeType::class, $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grade);
            $entityManager->flush();

            return $this->redirectToRoute('grade_index');
        }

        return $this->render('Back/grade/new.html.twig', [
            'grade' => $grade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grade_show", methods={"GET"})
     */
    public function show(Grade $grade): Response
    {
        return $this->render('grade/show.html.twig', [
            'grade' => $grade,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="grade_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Grade $grade): Response
    {
        $form = $this->createForm(GradeType::class, $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grade_index', [
                'id' => $grade->getId(),
            ]);
        }

        return $this->render('Back/grade/edit.html.twig', [
            'grade' => $grade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grade_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Grade $grade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grade->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($grade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('grade_index');
    }
}
