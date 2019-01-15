<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('Front/index.html.twig');
    }
}
