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

class PromotionController extends AbstractController
{
    /**
     * @Route("/school/promotion/", name="promotion_index", methods={"GET"})
     */
    public function index(Request $request, PromotionRepository $promotionRepository, PaginatorInterface $paginator): Response
    {
        $page = $request->query->getInt('page', 1);

        $promotions = $promotionRepository->findAll();

        $allPromotions = $paginator->paginate($promotions, $page, 10);

        return $this->render('Back/promotion/index.html.twig', [
            'promotions' => $allPromotions,
        ]);
    }

    /**
     * @Route("/school/promotion/new", name="promotion_new", methods={"GET","POST"})
     */
    public function new(Request $request, ClassroomRepository $classroomRepository): Response
    {
        $promotion = new Promotion();
        $promotion->addClassroomBulk($classroomRepository->findAll());

        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promotion);
            $entityManager->flush();

            return $this->redirectToRoute('promotion_index');
        }

        return $this->render('Back/promotion/new.html.twig', [
            'promotion' => $promotion,
            'form' => $form->createView(),
        ]);
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
    public function edit(Request $request, Promotion $promotion): Response
    {
        $form = $this->createForm(PromotionEditType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promotion_index', [
                'id' => $promotion->getId(),
            ]);
        }

        return $this->render('Back/promotion/edit.html.twig', [
            'promotion' => $promotion,
            'form' => $form->createView(),
        ]);
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
