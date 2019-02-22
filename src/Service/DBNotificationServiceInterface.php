<?php

namespace App\Service;

use App\Entity\User;

interface DBNotificationServiceInterface
{
    public function notify(string $type, $recipient, string $content, int $ressource): ?bool;
}
