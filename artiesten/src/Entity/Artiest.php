<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtiestRepository")
 */
class Artiest
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
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Optreden", mappedBy="artiest_id")
     */
    private $optredens;

    public function __construct()
    {
        $this->optredens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * @return Collection|Optreden[]
     */
    public function getOptredens(): Collection
    {
        return $this->optredens;
    }

    public function addOptreden(Optreden $optreden): self
    {
        if (!$this->optredens->contains($optreden)) {
            $this->optredens[] = $optreden;
            $optreden->setArtiestId($this);
        }

        return $this;
    }

    public function removeOptreden(Optreden $optreden): self
    {
        if ($this->optredens->contains($optreden)) {
            $this->optredens->removeElement($optreden);
            // set the owning side to null (unless already changed)
            if ($optreden->getArtiestId() === $this) {
                $optreden->setArtiestId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->id."-". $this->naam;
    }
}
