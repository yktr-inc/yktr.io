<?php

namespace App\Security;

use App\Entity\Course;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class CourseVoter extends Voter
{
    const VIEW = 'view';
    const CREATE = 'create';
    const EDIT = 'edit';
    const DELETE = 'delete';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::CREATE, self::EDIT, self::DELETE])) {
            return false;
        }

        if (!$subject instanceof Course) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Course $course */
        $course = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($course, $user);
            case self::CREATE:
                return $this->canCreate();
            case self::EDIT:
                return $this->canEdit($course, $user);
            case self::DELETE:
                return $this->canDelete();
        }

        throw new \LogicException('Wtf Bro');
    }

    private function canView(Course $course, User $user)
    {
        if ($this->canEdit($course, $user) || $this->canCreate()) {
            return true;
        }
        if ($this->security->isGranted('ROLE_STUDENT')) {
            return $user->getClassroom() === $course->getTeacher();
        }
        return false;
    }

    private function canCreate()
    {
        if ($this->security->isGranted('ROLE_SUPERADMIN') || $this->security->isGranted('ROLE_ADMINISTRATIVE')) {
            return true;
        }
        return false;
    }

    private function canDelete()
    {
        if ($this->security->isGranted('ROLE_SUPERADMIN') || $this->security->isGranted('ROLE_ADMINISTRATIVE')) {
            return true;
        }
        return false;
    }

    private function canEdit(Course $course, User $user)
    {
        if ($this->security->isGranted('ROLE_SUPERADMIN') || $this->security->isGranted('ROLE_ADMINISTRATIVE')) {
            return true;
        }
        if ($this->security->isGranted('ROLE_TEACHER')) {
            return $user === $course->getTeacher();
        }
        return false;
    }
}
