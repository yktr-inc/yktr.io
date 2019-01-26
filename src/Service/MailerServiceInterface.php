<?php

namespace App\Service;

interface MailerServiceInterface
{
  public function send(string $message);
}
