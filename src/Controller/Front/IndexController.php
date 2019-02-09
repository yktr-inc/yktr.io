<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DBNotificationServiceInterface;
use App\Service\MailerServiceInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        DBNotificationServiceInterface $notifService,
        MailerServiceInterface $mailerService,
        UserRepository $userRepository,
        Security $security)
    {

        if($this->getUser()){
            $succeed = $notifService->notify("GRADE", $this->getUser(), "Salut à tous");
            dd($succeed);
        }

        return $this->render('Front/index.html.twig');
    }
}
