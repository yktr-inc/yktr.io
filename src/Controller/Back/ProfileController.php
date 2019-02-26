<?php
namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserProfileType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\CRUDController;

/**
 * @Route("/profile")
 */
class ProfileController extends CRUDController
{

    /**
     * @Route("/", name="user_profile", methods="GET")
     */
    public function show(): Response
    {
        return $this->render('Back/user/profile.html.twig', ['user'=>$this->getUser()]);
    }

    /**
     * @Route("/edit", name="user_profile_edit", methods="GET|POST")
     */
    public function edit(): Response
    {
        $options = [
            'redirect' => 'user_profile',
            'template' => 'Back/user/edit_profile.html.twig'
        ];

        $crud = $this->editAction($this->getUser(), UserProfileType::class, $options);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }
}
