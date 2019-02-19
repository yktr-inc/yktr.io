<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_SUPERADMIN', $rolesTab, true)) {
            $redirection = new RedirectResponse($this->router->generate('dashboard_school'));
        }
        if (in_array('ROLE_ADMINISTRATIVE', $rolesTab, true)) {
            $redirection = new RedirectResponse($this->router->generate('dashboard_school'));
        }
        if (in_array('ROLE_TEACHER', $rolesTab, true)) {
            $redirection = new RedirectResponse($this->router->generate('dashboard_teacher'));
        }
        if (in_array('ROLE_STUDENT', $rolesTab, true)) {
            $redirection = new RedirectResponse($this->router->generate('dashboard'));
        }


        return $redirection;
    }
}
