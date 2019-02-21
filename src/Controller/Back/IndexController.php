<?php
namespace App\Controller\Back;

use App\Service\ImpersonateUserList;
use App\Repository\ExamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class IndexController extends AbstractController
{
    /**
     * @Route("/student", methods={"GET"}, name="dashboard")
     * @Security("!is_granted('ROLE_SUPERADMIN') or !is_granted('ROLE_ADMINISTRATIVE') or !is_granted('ROLE_TEACHER')")
     */
    public function dashboard(ExamRepository $examRepository)
    {
        // $lastExams = $examRepository->findLastExams(5, $this->getUser()->getClassroom());
        return $this->render('Back/dashboard/index.html.twig', [
            'lastExams' => []
        ]);
    }

    /**
     * @Route("/teacher", methods={"GET"}, name="dashboard_teacher")
     * @Security(" !is_granted('ROLE_SUPERADMIN') or !is_granted('ROLE_ADMINISTRATIVE') ")
     */
    public function dashboardTeacher(ExamRepository $examRepository)
    {
        return $this->render('Back/dashboard/teacher.html.twig');
    }

    /**
     * @Route("/school", methods={"GET"}, name="dashboard_school")
     */
    public function dashboardSchool(ImpersonateUserList $impersonator, ExamRepository $examRepository)
    {
        $impersonateList = $impersonator->getImpersonate();
        return $this->render('Back/dashboard/school.html.twig', [
            'impersonateList' => $impersonateList
        ]);
    }
}
