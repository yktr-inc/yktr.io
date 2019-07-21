<?php

namespace App\Entity;

use App\Entity\Traits\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Grade
{
    use DateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="grades")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="grades")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */
    private $course;

    /**
     * Assert\NotBlank(
     *     message = "La note ne peut pas être vide"
     * )
     * @ORM\Column(type="float", nullable=false)
     */
    private $value;

    /**
     * Assert\NotBlank(
     *     message = "Le coefficient ne peut pas être vide"
     * )
     * @ORM\Column(type="float", nullable=false)
     */
    private $coefficient;

    /**
     * Assert\NotBlank(
     *     message = "La note doit avoir un type"
     * )
     * @ORM\Column(type="string", nullable=false)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     *
     * @return self
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    public function getType(): ?String
    {
        return $this->type;
    }

    public function setType(?String $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCoefficient(): ?Int
    {
        return $this->coefficient;
    }

    public function setCoefficient(?Int $coeff): self
    {
        $this->coefficient = $coeff;

        return $this;
    }
}
