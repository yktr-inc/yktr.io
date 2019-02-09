<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 * "code",
 * message="This promotion already exist"
 * )
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @Assert\Length(
     *      min = 1,
     *      max = 100,
     *      minMessage = "L'année de la promotion doit faire au moins {{ limit }} caractères",
     *      maxMessage = "L'année de la promotion ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $year;


    /**
     *  @Assert\Length(
     *      min = 1,
     *      max = 20,
     *      minMessage = "Le code de la promotion doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le code de la promotion ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=25, nullable=false, unique=true)
     */
    private $code;


    /**
     *  @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "La spécialité ne doit faire au moins {{ limit }} caractères",
     *      maxMessage = "La spécialité ne ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=70, nullable=false)
     */
    private $speciality;

    /**
     * @Assert\Date()
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $startedAt;

    /**
     * @Assert\Date()
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $finishedAt;

    /**
     * @ORM\OneToMany(targetEntity="Classroom", mappedBy="promotion")
     */
    private $classrooms;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeInterface
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTimeInterface $finishedAt): self
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    /**
     * @return Collection|Classroom[]
     */
    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): self
    {
        if (!$this->classrooms->contains($classroom)) {
            $this->classrooms[] = $classroom;
            $classroom->setPromotion($this);
        }

        return $this;
    }

    public function addClassroomBulk(Array $classrooms): self
    {
        foreach ($classrooms as $classroom) {
            $this->addClassroom($classroom);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): self
    {
        if ($this->classrooms->contains($classroom)) {
            $this->classrooms->removeElement($classroom);
            // set the owning side to null (unless already changed)
            if ($classroom->getPromotion() === $this) {
                $classroom->setPromotion(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
