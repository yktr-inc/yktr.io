<?php

namespace App\Controller\Back;

use App\Entity\Notification;
use App\Form\NotificationType;
use App\Repository\NotificationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;

/**
 * @Route("/dashboard/notifications")
 */
class NotificationController extends CRUDController
{
    /**
     * @Route("/", name="notification_index", methods={"GET"})
     */
    public function index(NotificationRepository $notificationRepository): Response
    {
        $notifications = $notificationRepository->findBy(['user'=>$this->getUser()]);

        $crud = $this->indexAction($notifications, Notification::class);

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/{id}", name="notification_show", methods={"GET"})
     */
    public function show(Notification $notification): Response
    {
        return $this->render('Back/notification/show.html.twig', [
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/{id}", name="notification_delete", methods={"DELETE"})
     */
    public function delete(Notification $notification): Response
    {
        $this->deleteAction($notification);
        return $this->redirectToRoute('notification_index');
    }
}
