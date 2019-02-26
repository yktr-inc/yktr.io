<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use App\Service\MailerServiceInterface;

class MailerService implements MailerServiceInterface
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(string $title, $recipient, string $sender, string $message, ?array $config = [])
    {
        $recipient = is_array($recipient)?$this->groupFormat($recipient):$recipient;

        $mail = (new \Swift_Message($title))
        ->setFrom($sender);

        isset($config['cc'])?$mail->setCc($recipient):$mail->setTo($recipient);

        $mail->setBody($message);

        $this->mailer->send($mail);
    }

    public function groupFormat($recipient)
    {
        $output = [];
        foreach ($recipient as $user) {
            $output[$user->getEmail()] = $user->getFullname();
        }
        return $output;
    }
}
