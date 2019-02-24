<?php

namespace App\Controller\Back;

use App\Entity\Setting;
use App\Form\SettingType;
use App\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CRUDController;

class SettingController extends CRUDController
{
    /**
     * @Route("/admin/setting", name="setting_index", methods={"GET"})
     */
    public function index(SettingRepository $settingRepository): Response
    {
        return $this->render('Back/setting/index.html.twig', [
            'settings' => $settingRepository->findAll(),
        ]);
    }


    /**
     * @Route("/admin/setting/{id}/edit", name="setting_edit", methods={"GET","POST"})
     */
    public function edit(Setting $setting): Response
    {
        $crud = $this->editAction($setting);

        if ($crud->getType() === 'redirect') {
            return $crud->getRedirect();
        }

        return $this->render($crud->getTemplate(), $crud->getArgs());
    }
}
