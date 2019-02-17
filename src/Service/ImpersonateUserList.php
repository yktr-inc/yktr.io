<?php
namespace App\Service;

use Symfony\Component\Security\Core\Security;

class ImpersonateUserList
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getImpersonate()
    {
        $userList=[];

        if ($this->security->isGranted('ROLE_PREVIOUS_ADMIN') || $this->security->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $userList=['student','administrative','teacher'];
        }
        return $userList;
    }
}
