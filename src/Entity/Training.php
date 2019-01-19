<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="slug_idx", columns={"slug"})})
 */
class Training
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
     * @ORM\Column(type="boolean")
     */
    private $bsc;
    /**
     * @ORM\Column(type="boolean")
     */
    private $msc;
    /**
     * @ORM\Column(type="boolean")
     */
    private $bprof;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subject", mappedBy="training")
     */
    private $subjects;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
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
    public function getBsc(): ?bool
    {
        return $this->bsc;
    }

    public function setBsc(bool $bsc): self
    {
        $this->bsc = $bsc;

        return $this;
    }
    public function getMsc(): ?bool
    {
        return $this->msc;
    }

    public function setMsc(bool $msc): self
    {
        $this->msc = $msc;

        return $this;
    }
    public function getBprof(): ?bool
    {
        return $this->bprof;
    }

    public function setBprof(bool $bprof): self
    {
        $this->bprof = $bprof;

        return $this;
    }
    /**
     * @return Collection|Subject[]
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->setTraining($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->contains($subject)) {
            $this->subjects->removeElement($subject);
            // set the owning side to null (unless already changed)
            if ($subject->getTraining() === $this) {
                $subject->setTraining(null);
            }
        }

        return $this;
    }
    public function getType(){
        return ($this->bsc?'bsc':($this->msc?'msc':($this->bprof?'bprof':'egyeb')));
    }
    public function getType2(){
        return ($this->bsc?'BSc':($this->msc?'MSc':($this->bprof?'BProf':'?')));
    }
}
