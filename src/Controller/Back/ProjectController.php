<?php

namespace App\Controller\Back;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CourseRepository;
use App\Service\DBNotificationServiceInterface;
use App\Controller\CRUDController;

class ProjectController extends CRUDController
{
    /**
     * @Route("/school/project", name="project_index", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        $crud = $this->indexAction($projects, Project::class);
        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/project/new", name="project_new", methods={"GET","POST"})
     * @Route("/teacher/course/{id}/project/new", name="teacher_project_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        CourseRepository $courseRepository,
        DBNotificationServiceInterface $notifService
    ): Response {
        $courseId = $request->attributes->get('id');

        $project = new Project();

        if ($request->attributes->get('id')) {
            $course = $courseRepository->findOneById($courseId);
            $project->setCourse($course);
        }



        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
            $recipients = $project->getCourse()->getClassroom()->getUsers();
            $courseName = $project->getCourse()->getTitle();

            $notifService->notify(
                "PROJECT",
                $recipients,
                "New project for ".$courseName,
                $project->getId()
            );

            if ($request->attributes->get('id')) {
                return $this->redirectToRoute('teacher_course_index', ['id' => $course->getId()]);
            }
            return $this->redirectToRoute('project_index');
        }

        return $this->render('Back/project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/project/{id}", name="project_show", methods={"GET"})
     */
    public function show(Project $project): Response
    {
        return $this->render('Back/project/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/school/project/{id}/edit", name="project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Project $project): Response
    {
        $crud = $this->editAction($project);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/project/{id}", name="project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project): Response
    {
        $this->deleteAction($project);
        return $this->redirectToRoute('project_index');
    }
}
