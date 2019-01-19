<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="slug_idx", columns={"slug"})})
 * @Vich\Uploadable
 */
class Material
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=127)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContentType", inversedBy="materials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="materials")
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metadata;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnail;
    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail")
     * @var File
     */
    private $thumbnailFile;
    /**
     * @ORM\Column(type="string", length=511, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;
    /**
     * @Vich\UploadableField(mapping="materials", fileNameProperty="file")
     * @var File
     */
    private $fileFile;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;
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
    public function __toString() {
        return $this->title;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getType(): ?ContentType
    {
        return $this->type;
    }

    public function setType(?ContentType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
    public function setThumbnailFile(File $thumbnail = null)
    {
        $this->thumbnailFile = $thumbnail;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($thumbnail) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }
    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }
    public function setFileFile(File $file = null)
    {
        $this->fileFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getFileFile()
    {
        return $this->fileFile;
    }
}
