<?php

namespace App\Controller;

use App\Service\DBNotificationServiceInterface;
use App\Service\FileUploader;
use App\Utils\CRUD;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CRUDController extends AbstractController
{
    protected $requestStack;

    public function __construct(
        PaginatorInterface $paginator,
        RequestStack $requestStack,
        FileUploader $fileUploader
    ) {
        $this->paginator = $paginator;
        $this->requestStack = $requestStack;
        $this->fileUploader = $fileUploader;
    }

    public function newAction($ressource, $formType = '', $options = [])
    {
        $request = $this->requestStack->getCurrentRequest();

        $obj = empty($options['obj']) ? new $ressource : $options['obj'];
        $className = self::getObjectName($obj);
        $template = empty($options['template']) ? 'Back/'.$className.'/new.html.twig' : $options['template'];
        $redirect = empty($options['redirect']) ? $className.'_index' : $options['redirect'];
        $formType = empty($formType) ? 'App\\Form\\'.ucfirst($className).'Type' : $formType;

        $form = $this->createForm($formType, $obj);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            $redirect = $this->redirectToRoute($redirect);

            return new CRUD('redirect', null, [ 'obj' => $obj ], $redirect);
        }

        $args = [ $className => $obj, 'form' => $form->createView() ];

        return new CRUD('view', $template, $args);
    }

    public function editAction($obj, $formType = '', $options = [])
    {
        $request = $this->requestStack->getCurrentRequest();

        $className = self::getObjectName($obj);
        $template = empty($options['template']) ? 'Back/'.$className.'/edit.html.twig' : $options['template'];
        $redirect = empty($options['redirect']) ? $className.'_show' : $options['redirect'];
        $formType = empty($formType) ? 'App\\Form\\'.ucfirst($className).'Type' : $formType;
        $fileKey = empty($options['files']) ? false : $options['files'];
        $fileRelationAccessor = empty($options['accessor']) ? false : $options['accessor'];

        $form = $this->createForm($formType, $obj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($fileKey) {
                $getMethod = 'getAvatar';
                $file = $obj->$fileRelationAccessor($fileKey);
                $newFile = $this->fileUploader->upload($file);
                $obj->setAvatar($newFile);
            }
            $this->getDoctrine()->getManager()->flush($obj);

            $redirect =  $this->redirectToRoute($redirect, [
                'id' => $obj->getId(),
            ]);

            return new CRUD('redirect', null, null, $redirect);
        }

        $args = [ $className => $obj, 'form' => $form->createView() ];

        return new CRUD('view', $template, $args);
    }

    public function deleteAction($obj)
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($this->isCsrfTokenValid('delete'.$obj->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($obj);
            $entityManager->flush();
        }
    }

    public function showAction($obj, $options = [])
    {
        $className = empty($className) ? self::getObjectName($obj) : $className;
        $template = empty($options['template']) ? 'Back/'.$className.'/show.html.twig' : $options['template'];

        $args = [ $template => $obj ];

        return new CRUD('view', $template, $args);
    }

    public function indexAction($ressources, $class, $options = [])
    {
        $request = $this->requestStack->getCurrentRequest();

        $className = self::getClassName($class);
        $perPage = empty($options['perPage']) ? 10 : $options['perPage'];
        $template = empty($options['template']) ? 'Back/'.$className.'/index.html.twig' : $options['template'];

        $page = $request->query->getInt('page', 1);
        $paginatedObj = $this->paginator->paginate($ressources, $page, 10);

        $args = [ $className.'s' => $paginatedObj ];

        return new CRUD('view', $template, $args);
    }

    private static function getObjectName($obj)
    {
        $path = explode('\\', get_class($obj));
        return strtolower(array_pop($path));
    }
    private static function getClassName($classStr)
    {
        $path = explode('\\', $classStr);
        return strtolower(array_pop($path));
    }
}
