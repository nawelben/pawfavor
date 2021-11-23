<?php

namespace App\Entity;

use App\Repository\SitterHomeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SitterHomeRepository::class)
 */
class SitterHome
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="sitterHome", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sitter;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $bigHouse;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $parkNearby;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $dogParkNearby;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $outDoorArea;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $fencedBackyard;

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

    public function getBigHouse(): ?int
    {
        return $this->bigHouse;
    }

    public function setBigHouse(?int $bigHouse): self
    {
        $this->bigHouse = $bigHouse;

        return $this;
    }

    public function getParkNearby(): ?int
    {
        return $this->parkNearby;
    }

    public function setParkNearby(?int $parkNearby): self
    {
        $this->parkNearby = $parkNearby;

        return $this;
    }

    public function getDogParkNearby(): ?int
    {
        return $this->dogParkNearby;
    }

    public function setDogParkNearby(?int $dogParkNearby): self
    {
        $this->dogParkNearby = $dogParkNearby;

        return $this;
    }

    public function getOutDoorArea(): ?int
    {
        return $this->outDoorArea;
    }

    public function setOutDoorArea(?int $outDoorArea): self
    {
        $this->outDoorArea = $outDoorArea;

        return $this;
    }

    public function getFencedBackyard(): ?int
    {
        return $this->fencedBackyard;
    }

    public function setFencedBackyard(?int $fencedBackyard): self
    {
        $this->fencedBackyard = $fencedBackyard;

        return $this;
    }
}
