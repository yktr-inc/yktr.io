<?php

namespace App\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Information;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class OwnerListener
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage = null)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Information) {
            return;
        }

        if (null !== $currentUser = $this->getUser()) {
            $entity->setOwner($currentUser);
        } else {
            $entity->setOwner(0);
        }
    }

    public function getUser()
    {
        if (!$this->tokenStorage) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            return;
        }

        return $user;
    }
}
