<?php

namespace App\Entity;

use App\Repository\PaddockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(nullable=true)
     * TODO PASS NOT NULLABLE
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

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="Paddock")
     */
    private $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

//    /**
//     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="paddock")
//     */
//    private $Animals;

//    public function __construct()
//    {
//        $this->Animals = new ArrayCollection();
//    }

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

//    /**
//     * @return Collection<int, Animal>
//     */
//    public function getAnimals(): Collection
//    {
//        return $this->Animals;
//    }
//
//    public function addAnimal(Animal $animal): self
//    {
//        if (!$this->Animals->contains($animal)) {
//            $this->Animals[] = $animal;
//            $animal->setPaddock($this);
//        }
//
//        return $this;
//    }
//
//    public function removeAnimal(Animal $animal): self
//    {
//        if ($this->Animals->removeElement($animal)) {
//            // set the owning side to null (unless already changed)
//            if ($animal->getPaddock() === $this) {
//                $animal->setPaddock(null);
//            }
//        }
//
//        return $this;
//    }

/**
 * @return Collection<int, Animal>
 */
public function getAnimals(): Collection
{
    return $this->animals;
}

public function addAnimal(Animal $animal): self
{
    if (!$this->animals->contains($animal)) {
        $this->animals[] = $animal;
        $animal->setPaddock($this);
    }

    return $this;
}

public function removeAnimal(Animal $animal): self
{
    if ($this->animals->removeElement($animal)) {
        // set the owning side to null (unless already changed)
        if ($animal->getPaddock() === $this) {
            $animal->setPaddock(null);
        }
    }

    return $this;
}
}
