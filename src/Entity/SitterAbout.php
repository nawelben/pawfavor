<?php

namespace App\Entity;

use App\Repository\SitterAboutRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SitterAboutRepository::class)
 */
class SitterAbout
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="sitterAbout", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $short;

    /**
     * @ORM\Column(type="string", length=1500, nullable=true)
     */
    private $longDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSitter(): ?User
    {
        return $this->sitter;
    }

    public function setSitter(User $sitter): self
    {
        $this->sitter = $sitter;

        return $this;
    }

    public function getShort(): ?string
    {
        return $this->short;
    }

    public function setShort(?string $short): self
    {
        $this->short = $short;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(?string $longDescription): self
    {
        $this->longDescription = $longDescription;

        return $this;
    }
}
