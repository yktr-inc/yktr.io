<?php
namespace App\Controller\Back;

use App\Service\ImpersonateUserList;
use App\Repository\ExamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/dashboard", methods={"GET"}, name="dashboard")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboard(ImpersonateUserList $impersonator, ExamRepository $examRepository)
    {
        // dd($env);
        $impersonateList = $impersonator->getImpersonate();
        $lastExams = $examRepository->findLastExams(5, $this->getUser()->getClassroom());
        return $this->render('Back/dashboard/index.html.twig', [
            'impersonateList' => $impersonateList,
            'lastExams' => $lastExams
        ]);
    }
}
