<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\DateTrait;
use App\Entity\Traits\PublishedTrait;
use App\Entity\Traits\OwnerTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Information
{
    use DateTrait;
    use PublishedTrait;
    use OwnerTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le titre de l'information doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le titre de l'information ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @Assert\NotBlank(
     *     message = "Le contenu de l'information ne devrait pas être vide"
     * )
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
