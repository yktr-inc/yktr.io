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
     * @Route("/student", methods={"GET"}, name="dashboard")
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

    /**
     * @Route("/teacher", methods={"GET"}, name="dashboard_teacher")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardTeacher(ImpersonateUserList $impersonator, ExamRepository $examRepository)
    {
        // dd($env);
        $impersonateList = $impersonator->getImpersonate();
        $lastExams = $examRepository->findLastExams(5, $this->getUser()->getClassroom());
        return $this->render('Back/dashboard/index.html.twig', [
            'impersonateList' => $impersonateList,
            'lastExams' => $lastExams
        ]);
    }

    /**
     * @Route("/school", methods={"GET"}, name="dashboard_admin")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardSchool(ImpersonateUserList $impersonator, ExamRepository $examRepository)
    {
        // dd($env);
        $impersonateList = $impersonator->getImpersonate();
        $lastExams = $examRepository->findLastExams(5, $this->getUser()->getClassroom());
        return $this->render('Back/dashboard/index.html.twig', [
            'impersonateList' => $impersonateList,
            'lastExams' => $lastExams
        ]);
    }

    /**
     * @Route("/admin", methods={"GET"}, name="dashboard_superadmin")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAdmin(ImpersonateUserList $impersonator, ExamRepository $examRepository)
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
