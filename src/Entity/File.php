<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\DateTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class File
{
    use DateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="file", fileNameProperty="file")
     */
    private $file;

    /**
     * @Assert\Choice(
     *     choices={"video", "image", "audio", "pdf", "file" },
     *     message="Le type de fichierr est incorrect."
     * )
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFile(File $devis = null)
    {
        $this->devisFile = $devis;

        if ($devis) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getFile()
    {
        return $this->devisFile;
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
