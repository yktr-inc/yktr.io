<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DBNotificationServiceInterface;
use App\Service\MailerServiceInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;
use App\Form\UserType;
use App\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\RedirectUserServiceInterface;

class IndexController extends CRUDController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RedirectUserServiceInterface $redirectUser)
    {
        if (!is_null($redirectUser->redirect())) {
            return $redirectUser->redirect();
        }
        return $this->redirectToRoute('app_front_security_login');
    }
}
