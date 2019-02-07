<?php

namespace App\Service;

interface MailerServiceInterface
{
  public function send(string $title, $recipient,string $sender, string $message,?array $config = []);
}
