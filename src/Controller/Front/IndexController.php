<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MailerService;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MailerService $mailerService)
    {

        $mailerService->send("Ma gueule");

        return $this->render('Front/index.html.twig');
    }
}
