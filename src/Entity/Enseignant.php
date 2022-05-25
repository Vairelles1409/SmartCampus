<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant
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
    private $nomEnseignant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $prenomEnseignant;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $adresseEnseignant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephoneEnseignant;

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

    public function getNomEnseignant(): ?string
    {
        return $this->nomEnseignant;
    }

    public function setNomEnseignant(?string $nomEnseignant): self
    {
        $this->nomEnseignant = $nomEnseignant;

        return $this;
    }

    public function getPrenomEnseignant(): ?string
    {
        return $this->prenomEnseignant;
    }

    public function setPrenomEnseignant(?string $prenomEnseignant): self
    {
        $this->prenomEnseignant = $prenomEnseignant;

        return $this;
    }

    public function getAdresseEnseignant(): ?string
    {
        return $this->adresseEnseignant;
    }

    public function setAdresseEnseignant(?string $adresseEnseignant): self
    {
        $this->adresseEnseignant = $adresseEnseignant;

        return $this;
    }

    public function getTelephoneEnseignant(): ?int
    {
        return $this->telephoneEnseignant;
    }

    public function setTelephoneEnseignant(?int $telephoneEnseignant): self
    {
        $this->telephoneEnseignant = $telephoneEnseignant;

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
