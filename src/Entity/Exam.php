<?php

namespace App\Entity;

use App\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Exam
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
     *     choices={"exam", "test" },
     *     message="Le type est incorrect."
     * )
     *
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    private $type;

    /**
     *  @Assert\Range(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom de l'examen doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'examen ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Classroom")
     * @ORM\JoinColumn(name="classroom_id", referencedColumnName="id")
     */
    private $classroom;

    /**
     *
     * @Assert\Date
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
