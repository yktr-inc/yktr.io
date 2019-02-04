<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MailerService;
use App\Repository\UserRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MailerService $mailerService, UserRepository $userRepository)
    {

        $users = $userRepository->findAll();

        $mailerService->send("MultiUser", $users, "Salut à tous");

        return $this->render('Front/index.html.twig');
    }
}
