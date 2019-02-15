<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;

class ColorThemeSelector implements ColorThemeSelectorInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getColorByRole(): ?string
    {
        $color="admin";

        if ($this->security->isGranted('ROLE_STUDENT')) {
            $color="primary";
        }
        if ($this->security->isGranted('ROLE_TEACHER')) {
            $color="secondary";
        }
        if ($this->security->isGranted('ROLE_ADMINISTRATIVE')) {
            $color="tertiary";
        }
        if ($this->security->isGranted('ROLE_SUPERADMIN')) {
            $color="admin";
        }

        return $color;
    }
}
