<?php

namespace App\Controller\Back;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Form\ClassroomEditType;
use App\Repository\ClassroomRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/school/classes", name="classroom_index", methods={"GET"})
     */
    public function index(Request $request, ClassroomRepository $classroomRepository, PaginatorInterface $paginator): Response
    {
        $page = $request->query->getInt('page', 1);

        $classrooms = $classroomRepository->findAll();

        $allClassrooms = $paginator->paginate($classrooms, $page, 10);

        return $this->render('Back/classroom/index.html.twig', [
            'classrooms' => $allClassrooms,
        ]);
    }

    /**
     * @Route("/school/class/new", name="classroom_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classroom);
            $entityManager->flush();

            return $this->redirectToRoute('classroom_index');
        }

        return $this->render('Back/classroom/new.html.twig', [
            'classroom' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/class/{id}", name="classroom_show", methods={"GET"})
     */
    public function show(Classroom $classroom): Response
    {
        return $this->render('Back/classroom/show.html.twig', [
            'classroom' => $classroom,
        ]);
    }

    /**
     * @Route("/school/class/{id}/edit", name="classroom_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classroom $classroom): Response
    {
        $form = $this->createForm(ClassroomEditType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classroom_index', [
                'id' => $classroom->getId(),
            ]);
        }

        return $this->render('Back/classroom/edit.html.twig', [
            'classroom' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/class/{id}", name="classroom_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Classroom $classroom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classroom->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classroom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('classroom_index');
    }
}
