<?php

namespace App\Service;

interface DBNotificationServiceInterface
{
  public function notify(string $type, $recipient, string $content): ?bool;

}
