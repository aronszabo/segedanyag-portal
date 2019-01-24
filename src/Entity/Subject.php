<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 * @ORM\Table(indexes={@ORM\Index(name="slug_idx", columns={"slug"})})
 * @Vich\Uploadable
 */
class Subject
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
    private $name;

    /**
     * @ORM\Column(type="string", length=127)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training", inversedBy="subjects", fetch="EAGER")
     */
    private $training;

    /**
     * @ORM\Column(type="string", length=127, nullable=true)
     */
    private $subjectcode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $semester;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=31, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Material", mappedBy="subject")
     * @ORM\OrderBy({"type" = "asc"})
     */
    private $materials;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;
    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
    public function __toString() {
        return $this->name;
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

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getSubjectcode(): ?string
    {
        return $this->subjectcode;
    }

    public function setSubjectcode(?string $subjectcode): self
    {
        $this->subjectcode = $subjectcode;

        return $this;
    }

    public function getSemester(): ?int
    {
        return $this->semester;
    }

    public function setSemester(?int $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Material[]
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setSubject($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->materials->contains($material)) {
            $this->materials->removeElement($material);
            // set the owning side to null (unless already changed)
            if ($material->getSubject() === $this) {
                $material->setSubject(null);
            }
        }

        return $this;
    }
}
