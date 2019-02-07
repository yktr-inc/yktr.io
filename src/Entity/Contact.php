<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $cellphone;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $homephone;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $workphone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    public function setCellphone(string $cellphone): self
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    public function getHomephone(): ?string
    {
        return $this->homephone;
    }

    public function setHomephone(?string $homephone): self
    {
        $this->homephone = $homephone;

        return $this;
    }

    public function getWorkphone(): ?string
    {
        return $this->workphone;
    }

    public function setWorkphone(?string $workphone): self
    {
        $this->workphone = $workphone;

        return $this;
    }
}
