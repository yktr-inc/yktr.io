<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Form\UserRegisterType;
use App\Form\UserEmailType;
use App\Form\UserPasswordType;
use App\Form\UserLoginType;
use App\Entity\User;
use App\Service\RedirectUserServiceInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Service\MailerServiceInterface;

/**
 * @Route(name="app_front_security_")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $helper, RedirectUserServiceInterface $redirectUser): Response
    {
        if (!is_null($redirectUser->redirect())) {
            return $redirectUser->redirect();
        }

        $user = new User();
        $form = $this->createForm(UserLoginType::class, $user);

        return $this->render('security/security.html.twig', [
            'error' => $helper->getLastAuthenticationError(),
            'label' => 'Login',
            'title' => 'Login in !',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/register", name="registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, RedirectUserServiceInterface $redirectUser)
    {

        if (!is_null($redirectUser->redirect())) {
            return $redirectUser->redirect();
        }

        $user = new User();
        $form = $this->createForm(UserRegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_front_security_login');
        }
        return $this->render(
            'security/security.html.twig',
            [
                'label' => 'Sign up',
                'title' => 'Register !',
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/forgot-password", name="forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        MailerServiceInterface $mailer,
        TokenGeneratorInterface $tokenGenerator,
        RedirectUserServiceInterface $redirectUser
    ): Response {

        if (!is_null($redirectUser->redirect())) {
            return $redirectUser->redirect();
        }
        $user = new User();
        $form = $this->createForm(UserEmailType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $user->getEmail();

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('app_front_security_forgotten_password');
            }
            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_front_security_forgotten_password');
            }

            $url = $this->generateUrl('app_front_security_reset_password', ['resetToken' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

            $body = "Follow this link to reset your password : " . $url;

            $mailer->send('Reset your password', $user->getEmail(), 'admin@yktr.io', $body);

            $this->addFlash('notice', 'Mail envoyé');

            return $this->redirectToRoute('app_front_security_login');
        }
        return $this->render(
            'security/forgotten_password.html.twig',
            [
                'label' => 'Sign up',
                'title' => 'Register !',
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/reset-password/{resetToken}", name="reset_password")
     */
    public function resetPassword(
        Request $request,
        string $resetToken,
        User $user,
        UserPasswordEncoderInterface $passwordEncoder,
        RedirectUserServiceInterface $redirectUser
    )
    {

        if (!is_null($redirectUser->redirect())) {
            return $redirectUser->redirect();
        }

        $form = $this->createForm(UserPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user === null || $user->getResetToken() === null) {
                $this->addFlash('danger', 'Unknown token');
                return $this->redirectToRoute('app_front_security_login');
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'Password updated');

            return $this->redirectToRoute('app_front_security_login');
        }
        return $this->render(
            'security/reset_password.html.twig',
            [
                'label' => 'Sign up',
                'title' => 'Register !',
                'form' => $form->createView()
            ]
        );
    }
}
