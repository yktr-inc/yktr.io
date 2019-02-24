<?php

namespace App\Controller\Back;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;

/**
 * @Route("/event")
 */
class EventController extends CRUDController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        $crud = $this->indexAction($events);

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(): Response
    {
        $crud = $this->newAction(Event::class);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('Back/event/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Event $event): Response
    {
        $crud = $this->editAction($event);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Event $event): Response
    {
        $this->deleteAction($event);

        return $this->redirectToRoute('event_index');
    }
}
