<?php

namespace App\Entity;

use App\Repository\BookingDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingDetailRepository::class)
 */
class BookingDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Pet::class)
     */
    private $pet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unknownPet;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="bookingDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function setPet(?Pet $pet): self
    {
        $this->pet = $pet;

        return $this;
    }

    public function getUnknownPet(): ?string
    {
        return $this->unknownPet;
    }

    public function setUnknownPet(?string $unknownPet): self
    {
        $this->unknownPet = $unknownPet;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): self
    {
        $this->booking = $booking;

        return $this;
    }
}
