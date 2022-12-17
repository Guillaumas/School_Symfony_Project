<?php

namespace App\Entity;

use App\Repository\SpaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpaceRepository::class)
 */
class Space
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $openDate;

    /**
     * @ORM\Column(type="date")
     */
    private $closeDate;

    /**
     * @ORM\OneToMany(targetEntity=Paddock::class, mappedBy="Space")
     */
    private $paddocks;

    public function __construct()
    {
        $this->paddocks = new ArrayCollection();
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

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getOpenDate(): ?\DateTimeInterface
    {
        return $this->openDate;
    }

    public function setOpenDate(?\DateTimeInterface $openDate): self
    {
        $this->openDate = $openDate;

        return $this;
    }

    public function getCloseDate(): ?\DateTimeInterface
    {
        return $this->closeDate;
    }

    public function setCloseDate(\DateTimeInterface $closeDate): self
    {
        $this->closeDate = $closeDate;

        return $this;
    }

    /**
     * @return Collection<int, Paddock>
     */
    public function getPaddocks(): Collection
    {
        return $this->paddocks;
    }

    public function addPaddock(Paddock $paddock): self
    {
        if (!$this->paddocks->contains($paddock)) {
            $this->paddocks[] = $paddock;
            $paddock->setSpace($this);
        }

        return $this;
    }

    public function removePaddock(Paddock $paddock): self
    {
        if ($this->paddocks->removeElement($paddock)) {
            // set the owning side to null (unless already changed)
            if ($paddock->getSpace() === $this) {
                $paddock->setSpace(null);
            }
        }

        return $this;
    }
}
