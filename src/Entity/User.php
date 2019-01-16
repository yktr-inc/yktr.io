<?php

namespace App\Entity;

use App\Entity\Traits\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="account")
 */
class User implements UserInterface
{
    //use DateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le nom d'utilisateur doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Le nom d'utilisateur ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     */
    private $username;

    /**
     *  @Assert\Email(
     *     message = "L'email saisi est invalide."
     * )
     *
     * @ORM\Column(type="string", length=200, unique=true, nullable=false)
     */
    private $email;

    /**
     * @Assert\Length(
     *      min = 8,
     *      max = 20,
     *      minMessage = "Le mot de passe doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Le mot de passe ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $password;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom de famille doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de famille ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $firstname;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le prénom ne peut pas faire plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $lastname;

    /**
     * @Assert\Date
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\OneToOne(targetEntity="File")
     * @ORM\JoinColumn(name="avatar", referencedColumnName="id")
     * @ORM\Column(nullable=true)
     */
    private $avatar;

    /**
     * @Assert\Choice(
     *     choices={"created", "active", "disable" },
     *     message="Le status est incorrect."
     * )
     *
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $status = 'created';

    /**
     * @ORM\OneToMany(targetEntity="Course", mappedBy="teacher")
     * @ORM\Column(nullable=true)
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="Attendance", mappedBy="user")
     * @ORM\Column(nullable=true)
     */
    private $attendances;

    /**
     * @ORM\OneToMany(targetEntity="Grade", mappedBy="user")
     * @ORM\Column(nullable=true)
     */
    private $grades;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->attendances = new ArrayCollection();
        $this->grades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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

    public function getAvatar(): ?File
    {
        return $this->avatar;
    }

    public function setAvatar(?File $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|Course[]
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->setTeacher($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->contains($course)) {
            $this->courses->removeElement($course);
            // set the owning side to null (unless already changed)
            if ($course->getTeacher() === $this) {
                $course->setTeacher(null);
            }
        }

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
            $attendance->setUser($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->contains($attendance)) {
            $this->attendances->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getUser() === $this) {
                $attendance->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Grade[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setUser($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->contains($grade)) {
            $this->grades->removeElement($grade);
            // set the owning side to null (unless already changed)
            if ($grade->getUser() === $this) {
                $grade->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
}
