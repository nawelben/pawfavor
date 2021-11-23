<?php

namespace App\Entity;

use App\Repository\SitterPetCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SitterPetCategoryRepository::class)
 */
class SitterPetCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sitter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $xsmall;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $small;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $medium;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $large;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $xlarge;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $cats;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $birds;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $guineapigs;

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

    public function getXsmall(): ?int
    {
        return $this->xsmall;
    }

    public function setXsmall(?int $xsmall): self
    {
        $this->xsmall = $xsmall;

        return $this;
    }

    public function getSmall(): ?int
    {
        return $this->small;
    }

    public function setSmall(?int $small): self
    {
        $this->small = $small;

        return $this;
    }

    public function getMedium(): ?int
    {
        return $this->medium;
    }

    public function setMedium(?int $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function getLarge(): ?int
    {
        return $this->large;
    }

    public function setLarge(?int $large): self
    {
        $this->large = $large;

        return $this;
    }

    public function getXlarge(): ?int
    {
        return $this->xlarge;
    }

    public function setXlarge(?int $xlarge): self
    {
        $this->xlarge = $xlarge;

        return $this;
    }

    public function getCats(): ?int
    {
        return $this->cats;
    }

    public function setCats(?int $cats): self
    {
        $this->cats = $cats;

        return $this;
    }

    public function getBirds(): ?int
    {
        return $this->birds;
    }

    public function setBirds(?int $birds): self
    {
        $this->birds = $birds;

        return $this;
    }

    public function getGuineapigs(): ?int
    {
        return $this->guineapigs;
    }

    public function setGuineapigs(?int $guineapigs): self
    {
        $this->guineapigs = $guineapigs;

        return $this;
    }
}
