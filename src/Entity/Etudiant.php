<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nomEtudiant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $prenomEtudiant;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $matriculeEtudiant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $niveauEtudiant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */

    private $filiereEtudiant;
    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $optionEtudiant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $adresseEtudiant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephoneEtudiant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nomEtudiant;
    }

    public function setNomEtudiant(?string $nomEtudiant): self
    {
        $this->nomEtudiant = $nomEtudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenomEtudiant;
    }

    public function setPrenomEtudiant(?string $prenomEtudiant): self
    {
        $this->prenomEtudiant = $prenomEtudiant;

        return $this;
    }

    public function getMatriculeEtudiant(): ?string
    {
        return $this->matriculeEtudiant;
    }

    public function setMatriculeEtudiant(?string $matriculeEtudiant): self
    {
        $this->matriculeEtudiant = $matriculeEtudiant;

        return $this;
    }

    public function getAdresseEtudiant(): ?string
    {
        return $this->adresseEtudiant;
    }

    public function setAdresseEtudiant(?string $adresseEtudiant): self
    {
        $this->adresseEtudiant = $adresseEtudiant;

        return $this;
    }

    public function getTelephoneEtudiant(): ?int
    {
        return $this->telephoneEtudiant;
    }

    public function setTelephoneEtudiant(?int $telephoneEtudiant): self
    {
        $this->telephoneEtudiant = $telephoneEtudiant;

        return $this;
    }
    public function getNiveauEtudiant(): ?string
    {
        return $this->niveauEtudiant;
    }

    public function setNiveauEtudiant(?string $niveauEtudiant): self
    {
        $this->niveauEtudiant = $niveauEtudiant;

        return $this;
    }

    public function getFiliereEtudiant(): ?string
    {
        return $this->filiereEtudiant;
    }

    public function setFiliereEtudiant(?string $filiereEtudiant): self
    {
        $this->filiereEtudiant = $filiereEtudiant;

        return $this;
    }

    public function getOptionEtudiant(): ?string
    {
        return $this->optionEtudiant;
    }

    public function setOptionEtudiant(?string $optionEtudiant): self
    {
        $this->optionEtudiant = $optionEtudiant;

        return $this;
    }
    
}
