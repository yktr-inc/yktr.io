<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;
use App\Service\RedirectUserServiceInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RedirectUserService implements RedirectUserServiceInterface
{
    private $router;

    public function __construct(RouterInterface $router, Security $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function redirect()
    {
        if ($this->security->isGranted('ROLE_SUPERADMIN')) {
            return new RedirectResponse($this->router->generate('dashboard_school'));
        }
        if ($this->security->isGranted('ROLE_ADMINISTRATIVE')) {
            return new RedirectResponse($this->router->generate('dashboard_school'));
        }
        if ($this->security->isGranted('ROLE_TEACHER')) {
            return new RedirectResponse($this->router->generate('dashboard_teacher'));
        }
        if ($this->security->isGranted('ROLE_STUDENT')) {
            return new RedirectResponse($this->router->generate('dashboard'));
        }

        return null;
    }
}
