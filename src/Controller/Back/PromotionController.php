<?php

namespace App\Controller\Back;

use App\Entity\Promotion;
use App\Entity\Classroom;
use App\Form\PromotionType;
use App\Form\PromotionEditType;
use App\Repository\PromotionRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;

class PromotionController extends CRUDController
{
    /**
     * @Route("/school/promotion/", name="promotion_index", methods={"GET"})
     */
    public function index(PromotionRepository $promotionRepository): Response
    {
        $promotions = $promotionRepository->findAll();

        $crud = $this->indexAction($promotions);

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/promotion/new", name="promotion_new", methods={"GET","POST"})
     */
    public function new(ClassroomRepository $classroomRepository): Response
    {
        $crud = $this->newAction(Promotion::class);

        if($crud->getType() === 'redirect'){
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/promotion/{id}", name="promotion_show", methods={"GET"})
     */
    public function show(Promotion $promotion): Response
    {
        return $this->render('Back/promotion/show.html.twig', [
            'promotion' => $promotion,
        ]);
    }

    /**
     * @Route("/school/promotion/{id}/edit", name="promotion_edit", methods={"GET","POST"})
     */
    public function edit(Promotion $promotion): Response
    {
        $crud = $this->editAction($promotion);

        if($crud->getType() === 'redirect'){
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/promotion/{id}", name="promotion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Promotion $promotion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promotion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($promotion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('promotion_index');
    }
}
