<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use App\Service\NotificationServiceInterface;
use App\Service\MailerServiceInterface;
use App\Service\DBNotifcationService;
use App\Service\DBNotifcationServiceInterface;

class NotificationService implements NotificationServiceInterface
{
    public function __construct(
    MailerServiceInterface $mailerService,
    DBNotifcationServiceInterface $DBNotifcationService
    ) {
        $this->mailerService = $mailerService;
        $this->DBNotifcationService = $DBNotifcationService;
    }

    public function notify()
    {
        return "notify";
    }
}
