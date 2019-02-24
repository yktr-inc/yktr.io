<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\CRUDController;

class UserController extends CRUDController
{
    /**
     * @Route("/school/admin/users", name="user_index", methods="GET")
     * @Route("/school/teachers", name="teacher_index", methods="GET")
     * @Route("/school/students", name="student_index", methods="GET")
     */
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $routeName = $request->get('_route');

        switch ($routeName) {
            case 'teacher_index':
                $users = $userRepository->findByRole('ROLE_TEACHER', true);
                break;
            case 'student_index':
                $users = $userRepository->findByRole('ROLE_STUDENT', true);;
                break;
            default:
                $users = $userRepository->findAll();
                break;
        }

        $crud = $this->indexAction($users, User::class);
        return $this->render($crud->getTemplate(), $crud->getArgs());
    }


    /**
     * @Route("/school/admin/user/new", name="user_new", methods="GET|POST")
     * @Route("/school/teacher/new", name="teacher_new", methods="GET|POST")
     * @Route("/school/student/new", name="student_new", methods="GET|POST")
     */
    public function new(): Response
    {
        $crud = $this->newAction(User::class);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/admin/user/{id}", name="user_show", methods="GET")
     * @Route("/school/teacher/{id}", name="teacher_show", methods="GET")
     * @Route("/school/student/{id}", name="student_show", methods="GET")
     */
    public function show(User $user): Response
    {
        return $this->render('Back/user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/school/admin/user/{id}/edit", name="user_edit", methods="GET|POST")
     * @Route("/school/teacher/{id}/edit", name="teacher_edit", methods="GET|POST")
     * @Route("/school/student/{id}/edit", name="student_edit", methods="GET|POST")
     */
    public function edit(User $user): Response
    {
        $crud = $this->editAction(User::class, UserEditType::class);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }

    /**
     * @Route("/school/admin/user/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(User $user): Response
    {
        $this->deleteAction($user);
        return $this->redirectToRoute('user_index');
    }
}
