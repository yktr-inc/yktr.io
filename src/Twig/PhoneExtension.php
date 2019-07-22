<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PhoneExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('format_phone', [$this, 'formatPhone'])
        ];
    }

    public function formatPhone(string $phone)
    {
        return preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', '\1 \2 \3 \4 \5', $phone);
    }
}
