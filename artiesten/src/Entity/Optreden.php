<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptredenRepository")
 */
class Optreden
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artiest", inversedBy="optredens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artiestid;

    /**
     * @ORM\Column(type="date")
     */
    private $Datum;

    /**
     * @ORM\Column(type="time")
     */
    private $aanvang;

    /**
     * @ORM\Column(type="integer")
     */
    private $zaal;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxSeats;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtiestId(): ?Artiest
    {
        return $this->artiestid;
    }

    public function setArtiestId(?Artiest $artiestid): self
    {
        $this->artiestid = $artiestid;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->Datum;
    }

    public function setDatum(\DateTimeInterface $Datum): self
    {
        $this->Datum = $Datum;

        return $this;
    }

    public function getAanvang(): ?\DateTimeInterface
    {
        return $this->aanvang;
    }

    public function setAanvang(\DateTimeInterface $aanvang): self
    {
        $this->aanvang = $aanvang;

        return $this;
    }

    public function getZaal(): ?int
    {
        return $this->zaal;
    }

    public function setZaal(int $zaal): self
    {
        $this->zaal = $zaal;

        return $this;
    }

    public function getMaxSeats(): ?int
    {
        return $this->maxSeats;
    }

    public function setMaxSeats(int $maxSeats): self
    {
        $this->maxSeats = $maxSeats;

        return $this;
    }
}
