<?php
namespace App\Controller\Back;

use App\Service\ImpersonateUserList;
use App\Repository\ExamRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectStepRepository;
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
    public function dashboard(ExamRepository $examRepository, ProjectStepRepository $projectStepRepository)
    {
        $classroom = $this->getUser()->getClassroom();

        $lastExams = $examRepository->findLastExams(5, $classroom);
        $lastProjects = $projectStepRepository->findLastProjectsSteps(5, 'project', $classroom);
        $lastTutorials = $projectStepRepository->findLastProjectsSteps(5, 'tutorial', $classroom);

        return $this->render('Back/dashboard/student.html.twig', [
            'lastExams' => $lastExams,
            'lastProjects' => $lastProjects,
            'lastTutorials' => $lastTutorials,
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
