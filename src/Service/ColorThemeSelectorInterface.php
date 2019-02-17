<?php

namespace App\Service;

interface ColorThemeSelectorInterface
{
    public function getColorByRole(): ?string;
}
