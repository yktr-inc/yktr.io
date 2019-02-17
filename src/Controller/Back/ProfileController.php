<?php
namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserProfileType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/dashboard/profile")
 */
class ProfileController extends AbstractController
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
    public function edit(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(UserProfileType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_profile', ['id' => $this->getUser()->getId()]);
        }

        return $this->render('Back/user/edit_profile.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }
}
