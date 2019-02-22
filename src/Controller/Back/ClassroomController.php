<?php

namespace App\Controller\Back;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Form\ClassroomEditType;
use App\Repository\ClassroomRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;

class ClassroomController extends CRUDController
{
    /**
     * @Route("/school/classes", name="classroom_index", methods={"GET"})
     */
    public function index(ClassroomRepository $classroomRepository): Response
    {
        $classrooms = $classroomRepository->findAll();

        $crud = $this->indexAction($classrooms);

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/class/new", name="classroom_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $crud = $this->newAction(Classroom::class);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
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
        $crud = $this->editAction($classroom);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/class/{id}", name="classroom_delete", methods={"DELETE"})
     */
    public function delete(Classroom $classroom): Response
    {
        $this->deleteAction($classroom);
        return $this->redirectToRoute('classroom_index');
    }
}
