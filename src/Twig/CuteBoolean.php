<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CuteBoolean extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('cuteBoolean', [$this, 'format'])
        ];
    }

    public function format(bool $type)
    {
        return $type ? 'Yes' : 'No';
    }
}
