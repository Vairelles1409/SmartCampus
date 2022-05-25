<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objetMessage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descMessage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnvoie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetMessage(): ?string
    {
        return $this->objetMessage;
    }

    public function setObjetMessage(?string $objetMessage): self
    {
        $this->objetMessage = $objetMessage;

        return $this;
    }

    public function getDescMessage(): ?string
    {
        return $this->descMessage;
    }

    public function setDescMessage(?string $descMessage): self
    {
        $this->descMessage = $descMessage;

        return $this;
    }

    public function getDateEnvoie(): ?\DateTimeInterface
    {
        return $this->dateEnvoie;
    }

    public function setDateEnvoie(?\DateTimeInterface $dateEnvoie): self
    {
        $this->dateEnvoie = $dateEnvoie;

        return $this;
    }
}
