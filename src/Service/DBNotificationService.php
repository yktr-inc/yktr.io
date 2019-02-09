<?php

namespace App\Service;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use App\Service\DBNotificationServiceInterface;
use App\Service\MailerServiceInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class DBNotificationService implements DBNotificationServiceInterface
{
    const NOTICATION_TYPES = [
    "GRADE",
    "ATTENDANCE",
    "EXAM",
    "PROJECT",
    "INFO",
    "SCHEDULE",
    "FILE"
    ];
    private $objectManager;

    public function __construct(
      ObjectManager $objectManager,
      NotificationRepository $notificationRepository,
      Security $security
    ) {
        $this->objectManager = $objectManager;
        $this->notificationRepository = $notificationRepository;
        $this->security = $security;
    }

    public function notify(string $type,User $recipient, string $content): ?bool
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

    public function getNotifications(){
        return $this->notificationRepository->findLast(5, $this->security->getUser());
    }

    public function getNotificationsCount(){
        return $this->notificationRepository->countNotif($this->security->getUser());
    }
}
