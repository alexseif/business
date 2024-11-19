<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BraindumpRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BraindumpRepository::class)]
#[ApiResource]
class Braindump
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $dump = null;

    public function __construct()
    {
        $today = new \DateTime();
        $this->name = $today->format('Y-m-d H:i');
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

    public function getDump(): ?string
    {
        return $this->dump;
    }

    public function setDump(string $dump): self
    {
        $this->dump = $dump;
        return $this;
    }
}
