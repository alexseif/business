<?php

namespace App\Entity;

use App\Repository\TimeManagementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeManagementRepository::class)]
class TimeManagement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $project = null;

    #[ORM\Column(length: 255)]
    private ?string $task = null;

    #[ORM\Column]
    private ?int $duration = 60;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $completed = null;

    public ?\DateTime $eta = null;

    /**
     * @return \DateTime|null
     */
    public function getEta(): ?\DateTime
    {
        return $this->eta;
    }

    /**
     * @param \DateTime|null $eta
     */
    public function setEta(?\DateTime $eta): void
    {
        $this->eta = $eta;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(string $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCompleted(): ?\DateTimeInterface
    {
        return $this->completed;
    }

    public function setCompleted(?\DateTimeInterface $completed): self
    {
        $this->completed = $completed;

        return $this;
    }
}
