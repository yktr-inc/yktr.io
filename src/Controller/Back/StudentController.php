<?php

namespace App\Controller\Back;

use App\Entity\Course;
use App\Entity\Exam;
use App\Entity\Project;
use App\Entity\ProjectGroup;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/courses", name="student_course_index", methods={"GET"})
     */
    public function courseIndex(CourseRepository $courseRepository): Response
    {
        $courses = $this->getUser()->getClassroom()->getCourses()->filter(
          function ($entry) {
              return $entry->getStatus() === 'ACTIVE';
          }
        );
        return $this->render('Back/course/student/index.html.twig', [
            'courses' => $courses,
        ]);
    }

    /**
     * @Route("/student/course/{id}", name="student_course_show", methods={"GET"})
     */
    public function courseShow(Request $request, Course $course, CourseRepository $courseRepository): Response
    {
        return $this->render('Back/course/student/show.html.twig', [
            'course' => $course,
            'grades' => []
        ]);
    }

    /**
     * @Route("/student/exam/{id}", name="student_exam_show", methods={"GET"})
     */
    public function showExam(Exam $exam): Response
    {
        return $this->render('Back/exam/student/show.html.twig', [
            'exam' => $exam,
            'course' => $exam->getCourse()
        ]);
    }

    /**
     * @Route("/student/project/{id}", name="student_project_show", methods={"GET"})
     */
    public function showProject(Project $project): Response
    {
        return $this->render('Back/project/student/show.html.twig', [
            'project' => $project,
            'course' => $project->getCourse()
        ]);
    }

    /**
     * @Route("/student/project/{id}/groups", name="student_project_groups", methods={"GET"})
     */
    public function showProjectGroups(Project $project, ProjectGroupRepository $pgr): Response
    {
        $userGroup = $pgr->findUserProjectGroup($project, $this->getUser());

        return $this->render('Back/project/student/show_groups.html.twig', [
            'project' => $project,
            'groups' => $project->getGroups(),
            'course' => $project->getCourse(),
            'userGroup' => $userGroup
        ]);
    }

    /**
     * @Route("/student/project/{id}/newGroup", name="student_project_new_group", methods={"GET"})
     */
    public function newProjectGroups(Project $project, ProjectGroupRepository $pgr): Response
    {
        $userGroup = $pgr->findUserProjectGroup($project, $this->getUser());

        if (empty($userGroup)) {
            $projectGroup = new ProjectGroup;
            $projectGroup->addStudent($this->getUser());
            $projectGroup->setProject($project);
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectGroup);
            $em->flush();
        }

        return $this->redirectToRoute('student_project_groups', ['id' => $project->getId()]);
    }

    /**
     * @Route("/student/projects", name="student_project_index", methods={"GET"})
     */
    public function indexProject(ProjectRepository $projectRepository): Response
    {
        $classroom = $this->getUser()->getClassroom();

        return $this->render('Back/project/student/index.html.twig', [
            'projects' => $projectRepository->findClassroomProjects('project', $classroom)
        ]);
    }

    /**
     * @Route("/student/project/{id}/leave-group", name="student_project_leave_group", methods={"GET"})
     */
    public function leaveGroupProject(ProjectGroupRepository $pgr, Project $project): Response
    {
        $userGroup = $pgr->findUserProjectGroup($project, $this->getUser());

        if (!empty($userGroup)) {
            $userGroup->removeStudent($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            if ($userGroup->getStudents()->isEmpty()) {
                $entityManager->remove($userGroup);
            }
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_project_groups', ['id' => $project->getId()]);
    }

    /**
     * @Route("/student/group/{id}/join", name="student_project_join_group", methods={"GET"})
     */
    public function joinGroupProject(ProjectGroupRepository $pgr, ProjectGroup $projectGroup): Response
    {
        $project = $projectGroup->getProject();

        $userGroup = $pgr->findUserProjectGroup($project, $this->getUser());

        if (empty($userGroup)) {
            $projectGroup->addStudent($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_project_groups', ['id' => $project->getId()]);
    }

    /**
     * @Route("/student/tutorials", name="student_tutorial_index", methods={"GET"})
     */
    public function indexTutorial(ProjectRepository $projectRepository): Response
    {
        $classroom = $this->getUser()->getClassroom();

        return $this->render('Back/project/student/index.html.twig', [
            'projects' => $projectRepository->findClassroomProjects('tutorial', $classroom)
        ]);
    }
}
