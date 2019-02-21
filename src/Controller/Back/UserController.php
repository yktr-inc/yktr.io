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

class UserController extends AbstractController
{
    /**
     * @Route("/school/admin/users", name="user_index", methods="GET")
     * @Route("/school/teachers", name="teacher_index", methods="GET")
     * @Route("/school/students", name="student_index", methods="GET")
     */
    public function index(Request $request, UserRepository $userRepository, PaginatorInterface $paginator): Response
    {
        $routeName = $request->get('_route');

        $page = $request->query->getInt('page', 1);

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

        $allUsers = $paginator->paginate($users, $page, 10);

        return $this->render('Back/user/index.html.twig', ['users' => $allUsers]);
    }


    /**
     * @Route("/school/admin/user/new", name="user_new", methods="GET|POST")
     * @Route("/school/teacher/new", name="teacher_new", methods="GET|POST")
     * @Route("/school/student/new", name="student_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('Back/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
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
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', ['id' => $user->getId()]);
        }

        return $this->render('Back/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/school/admin/user/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
