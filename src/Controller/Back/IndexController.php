<?php
namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/admin", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('Front/index.html.twig');
    }
}
