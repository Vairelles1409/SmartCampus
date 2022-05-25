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
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $matriculeEtudiant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $adresseEtudiant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephoneEtudiant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $password;

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
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
