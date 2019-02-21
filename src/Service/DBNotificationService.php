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
        "PROJECT"
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

    public function registerNotification(string $type, $recipient, string $content, int $ressource)
    {
        $notification = new Notification();
        $notification->setType($type);
        $notification->setContent($content);
        $notification->setLink(self::generateLink($type, $ressource));
        $notification->setUser($recipient);
        $this->objectManager->persist($notification);
        $this->objectManager->flush();
    }

    public function notify(string $type, $recipient, string $content, int $ressource): ?bool
    {
        if (self::verifyType($type)) {
            if (!$recipient instanceof User) {
                foreach ($recipient as $user) {
                    $this->registerNotification($type, $user, $content, $ressource);
                }
            } else {
                $this->registerNotification($type, $recipient, $content, $ressource);
            }
        }

        return true;
    }

    private static function verifyType($type)
    {
        return in_array($type, self::NOTICATION_TYPES);
    }

    public function getNotifications()
    {
        return $this->notificationRepository->findLast(5, $this->security->getUser());
    }

    public function getNotificationsCount()
    {
        return $this->notificationRepository->countNotif($this->security->getUser());
    }

    private static function generateLink($type, $ressource)
    {
        switch ($type) {
            case 'GRADE':
                return "/student/grade/".$ressource;
            case 'ATTENDANCE':
                return "/student/attendance/".$ressource;
            case 'EXAM':
                return "/student/exam/".$ressource;
            case 'PROJECT':
                return "/student/project/".$ressource;
            default:
                return "/student";
                break;
        }
    }
}
