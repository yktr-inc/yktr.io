<?php
namespace App\Controller\Back;

use App\Service\ImpersonateUserList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/dashboard", methods={"GET"}, name="dashboard")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboard(ImpersonateUserList $impersonator)
    {
        $impersonateList = $impersonator->getImpersonate();
        return $this->render('Back/dashboard/index.html.twig', ['impersonateList' => $impersonateList]);
    }
}
