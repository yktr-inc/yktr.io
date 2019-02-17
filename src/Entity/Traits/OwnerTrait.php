<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;

trait OwnerTrait
{

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $owner;


    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner(?User $owner)
    {
        $this->owner = $owner;

        return $this;
    }
}
