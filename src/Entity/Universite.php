<?php

namespace App\Entity;

use App\Repository\UniversiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniversiteRepository::class)
 */
class Universite
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
    private $nomUniversite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUniversite(): ?string
    {
        return $this->nomUniversite;
    }

    public function setNomUniversite(?string $nomUniversite): self
    {
        $this->nomUniversite = $nomUniversite;

        return $this;
    }
}
