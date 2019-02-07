<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class NotificationType extends AbstractExtension{
    public function getFilters(){
        return [
            new TwigFilter('noticationsType', [$this, 'formatType'])
        ];
    }

    public function formatType(string $type){
        switch ($type) {
          case 'GRADE':
            return "A new grade has been added";
          case 'ATTENDANCE':
            return "A new attendance has been added";
          case 'EXAM':
            return "A new exam has been programmed";
          case 'PROJECT':
            return "A new project has been added";
          default:
            break;
        }
    }
}
