<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $identificationNumber;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $brithDate;

    /**
     * @ORM\Column(type="date")
     */
    private $arrivalDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $departureDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $property;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $species;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sterilized;

    /**
     * @ORM\Column(type="boolean")
     */
    private $quarantaine;

    /**
     * @ORM\ManyToOne(targetEntity=Paddock::class, inversedBy="animals")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $Paddock;

//    /**
//     * @ORM\ManyToOne(targetEntity=Paddock::class, inversedBy="Animals")
//     */
//    private $paddock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentificationNumber(): ?string
    {
        return $this->identificationNumber;
    }

    public function setIdentificationNumber(int $identificationNumber): self
    {
        $this->identificationNumber = $identificationNumber;

        return $this;
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

    public function getBrithDate(): ?\DateTimeInterface
    {
        return $this->brithDate;
    }

    public function setBrithDate(?\DateTimeInterface $brithDate): self
    {
        $this->brithDate = $brithDate;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(?\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function isProperty(): ?bool
    {
        return $this->property;
    }

    public function setProperty(bool $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
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

    public function isSterilized(): ?bool
    {
        return $this->sterilized;
    }

    public function setSterilized(bool $sterilized): self
    {
        $this->sterilized = $sterilized;

        return $this;
    }

    public function isQuarantaine(): ?bool
    {
        return $this->quarantaine;
    }

    public function setQuarantaine(bool $quarantaine): self
    {
        $this->quarantaine = $quarantaine;

        return $this;
    }

//    public function getPaddock(): ?Paddock
//    {
//        return $this->paddock;
//    }
//
//    public function setPaddock(?Paddock $paddock): self
//    {
//        $this->paddock = $paddock;
//
//        return $this;
//    }

public function getPaddock(): ?Paddock
{
    return $this->Paddock;
}

public function setPaddock(?Paddock $Paddock): self
{
    $this->Paddock = $Paddock;

    return $this;
}
}
