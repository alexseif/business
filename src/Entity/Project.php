<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: TimeManagement::class)]
    private Collection $TimeManagement;

    public function __construct()
    {
        $this->TimeManagement = new ArrayCollection();
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

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, TimeManagement>
     */
    public function getTimeManagement(): Collection
    {
        return $this->TimeManagement;
    }

    public function addTimeManagement(TimeManagement $timeManagement): self
    {
        if (!$this->TimeManagement->contains($timeManagement)) {
            $this->TimeManagement->add($timeManagement);
            $timeManagement->setProject($this);
        }

        return $this;
    }

    public function removeTimeManagement(TimeManagement $timeManagement): self
    {
        if ($this->TimeManagement->removeElement($timeManagement)) {
            // set the owning side to null (unless already changed)
            if ($timeManagement->getProject() === $this) {
                $timeManagement->setProject(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
