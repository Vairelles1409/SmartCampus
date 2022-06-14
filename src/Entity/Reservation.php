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

    // /**
    //  * @ORM\Column(type="string", length=200, nullable=true)
    //  */
    // private $periodeMatin;

    // /**
    //  * @ORM\Column(type="string", length=200, nullable=true)
    //  */
    // private $periodeSoir;

    // /**
    //  * @ORM\Column(type="string", length=200, nullable=true)
    //  */
    // private $periodeTPE;

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="reservation")
     */
    private $periode;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="reservations")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getPeriodeMatin(): ?string
    // {
    //     return $this->periodeMatin;
    // }

    // public function setPeriodeMatin(?string $periodeMatin): self
    // {
    //     $this->periodeMatin = $periodeMatin;

    //     return $this;
    // }

    // public function getPeriodeSoir(): ?string
    // {
    //     return $this->periodeSoir;
    // }

    // public function setPeriodeSoir(?string $periodeSoir): self
    // {
    //     $this->periodeSoir = $periodeSoir;

    //     return $this;
    // }
    // public function getPeriodeTPE(): ?string
    // {
    //     return $this->periodeTPE;
    // }

    // public function setPeriodeTPE(?string $periodeTPE): self
    // {
    //     $this->periodeTPE = $periodeTPE;

    //     return $this;
    // }


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

    /**
     * Permet de savoir si une periode est choisi par un utilisateur
     *
     * 
     * @return boolean
     */
    public function isReservedByUserPeriode (User $user): bool{
        foreach($this->user as $periode){
            if($periode->getUser()===$user)return true;
        }
        return false;
    }

    // /**
    //  * Permet de savoir si une salle est choisi par un utilisateur
    //  *
    //  * @param User $user
    //  * @return boolean
    //  */
    // public function isReservedByUserSalle (User $user): bool{
    //     foreach($this->salle as $salles){
    //         if($salles->getUser()===$user)return true;
    //     }
    //     return false;
    // }
}
 