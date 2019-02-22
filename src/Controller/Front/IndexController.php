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

class IndexController extends CRUDController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
    DBNotificationServiceInterface $notifService,
    MailerServiceInterface $mailerService,
    UserRepository $userRepository,
    Security $security
) {
        if ($this->getUser()) {
            $succeed = $notifService->notify("GRADE", $this->getUser(), "Salut à tous", 1);
            dd($succeed);
        }

        return $this->render('Front/index.html.twig');
    }

    /**
     * @Route("/test/{id}", methods={"GET"})
     */
    public function test(User $user)
    {
        $tplInfos = $this->showAction($user);
        return $this->render($tplInfos['tpl'], $tplInfos['args']);
    }

    /**
     * @Route("/new", methods={"GET|POST"}, name="gros_test")
     */
    public function testNew(Request $request)
    {
        $tplInfos = $this->newAction($request, User::class);
        return $this->render($tplInfos['tpl'], $tplInfos['args']);
    }

    /**
     * @Route("/edit/{id}", methods={"GET|POST"})
     */
    public function testEdit(Request $request, User $user)
    {
        $tplInfos = $this->editAction($request, $user, UserType::class);

        return $this->render($tplInfos['tpl'], $tplInfos['args']);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"})
     */
    public function testDelete(Request $request, User $user)
    {
        $this->deleteAction($request, $user);

        return $this->redirectToRoute('gros_test');
    }

    /**
     * @Route("/index", methods={"GET"})
     */
    public function testIndex(Request $request, UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        $infos = $this->indexAction($request, $users);
        return $this->render($infos['tpl'], $infos['args']);
    }
}
