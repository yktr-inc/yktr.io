<?php

namespace App\Entity;

use App\Entity\Traits\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    use DateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Choice(
     *     choices={"tutorial", "project" },
     *     message = "Le type de projet est invalide"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $type;

    /**
     *  @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom du projet doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du projet ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     *  @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom du projet doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du projet ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="projects")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */
    private $course;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
