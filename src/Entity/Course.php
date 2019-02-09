<?php

namespace App\Entity;

use App\Entity\Traits\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Course
{
    use DateTrait;

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
     *      minMessage = "Le nom du cours doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du cours ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="courses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="Attendance", mappedBy="course")
     */
    private $attendances;

    public function __construct()
    {
        $this->attendances = new ArrayCollection();
    }

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(?User $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances[] = $attendance;
            $attendance->setCourse($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->contains($attendance)) {
            $this->attendances->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getCourse() === $this) {
                $attendance->setCourse(null);
            }
        }

        return $this;
    }
}
