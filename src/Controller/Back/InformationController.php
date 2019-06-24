<?php

namespace App\Controller\Back;

use App\Entity\Information;
use App\Form\InformationType;
use App\Repository\InformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;
use App\Service\DBNotificationServiceInterface;
use App\Repository\UserRepository;

class InformationController extends CRUDController
{
    /**
     * @Route("/school/information", name="information_index", methods={"GET"})
     */
    public function index(InformationRepository $informationRepository): Response
    {
        $events = $informationRepository->findAll();

        $crud = $this->indexAction($events, Information::class);

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/information/new", name="information_new", methods={"GET","POST"})
     */
    public function new(DBNotificationServiceInterface $notifService, UserRepository $userRepository): Response
    {
        $crud = $this->newAction(Information::class);

        if ($crud->getType() === 'redirect') {

            $newObj = $crud->getArgs()['obj'];

            $recipients = $userRepository->findAll();

            $notifService->notify(
                "INFORMATION",
                $recipients,
                "New information".$newObj->getTitle(),
                $newObj->getId()
            );

            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/information/{id}", name="information_show", methods={"GET"})
     */
    public function show(Information $information): Response
    {
        return $this->render('Back/information/show.html.twig', [
            'information' => $information,
        ]);
    }

    /**
     * @Route("/school/information/{id}/edit", name="information_edit", methods={"GET","POST"})
     */
    public function edit(Information $information): Response
    {
        $crud = $this->editAction($information);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/information/{id}", name="information_delete", methods={"DELETE"})
     */
    public function delete(Information $information): Response
    {
        $this->deleteAction($information);
        return $this->redirectToRoute('information_index');
    }
}
