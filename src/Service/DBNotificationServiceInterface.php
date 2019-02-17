<?php

namespace App\Service;

use App\Entity\User;

interface DBNotificationServiceInterface
{
    public function notify(string $type, User $recipient, string $content): ?bool;
}
