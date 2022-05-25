<?php

namespace App\Entity;

use App\Repository\PeriodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeriodeRepository::class)
 */
class Periode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $periodeRservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriodeRservation(): ?\DateTimeInterface
    {
        return $this->periodeRservation;
    }

    public function setPeriodeRservation(?\DateTimeInterface $periodeRservation): self
    {
        $this->periodeRservation = $periodeRservation;

        return $this;
    }
}
