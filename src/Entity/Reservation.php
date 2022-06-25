<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="reservation")
     */
    private $periode;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="reservations")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations",cascade={"persist"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
 