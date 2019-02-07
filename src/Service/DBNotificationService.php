<?php

namespace App\Service;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use App\Service\DBNotificationServiceInterface;
use App\Service\MailerServiceInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class DBNotificationService implements DBNotificationServiceInterface
{
    const NOTICATION_TYPES = [
    "GRADE",
    "ATTENDANCE",
    "EXAM",
    "PROJECT"
    ];
    private $objectManager;

    public function __construct(
      ObjectManager $objectManager,
      NotificationRepository $notificationRepository ) {
        $this->objectManager = $objectManager;
    }

    public function notify(string $type, $recipient, string $content): ?bool
    {
        if(self::verifyType($type)){

          $notification = new Notification();

          $notification->setType($type);
          $notification->setContent($content);
          $notification->setUser($recipient);

          $this->objectManager->persist($notification);
          $this->objectManager->flush();
          return true;
        }
        return false;
    }

    private static function verifyType($type){
      return in_array($type, self::NOTICATION_TYPES);
    }
}
