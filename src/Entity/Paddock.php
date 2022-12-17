<?php

namespace App\Entity;

use App\Repository\PaddockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaddockRepository::class)
 */
class Paddock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Space::class, inversedBy="paddocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Space;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Area;

    /**
     * @ORM\Column(type="integer")
     */
    private $MaxAnimals;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Quarantine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpace(): ?Space
    {
        return $this->Space;
    }

    public function setSpace(?Space $Space): self
    {
        $this->Space = $Space;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->Area;
    }

    public function setArea(int $Area): self
    {
        $this->Area = $Area;

        return $this;
    }

    public function getMaxAnimals(): ?int
    {
        return $this->MaxAnimals;
    }

    public function setMaxAnimals(int $MaxAnimals): self
    {
        $this->MaxAnimals = $MaxAnimals;

        return $this;
    }

    public function isQuarantine(): ?bool
    {
        return $this->Quarantine;
    }

    public function setQuarantine(bool $Quarantine): self
    {
        $this->Quarantine = $Quarantine;

        return $this;
    }
}
