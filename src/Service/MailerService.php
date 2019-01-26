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
    public function send(string $title, string $recipient, string $template)
    {
        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('yktrinc@gmail.com')
        ->setTo('vundaboy@gmail.com')
        ->setBody($message);

        $this->mailer->send($message);
    }

    public function sendToClassroom()
    {

    }
}
