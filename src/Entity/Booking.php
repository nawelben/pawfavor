<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sitterBooking")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sitter;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ownerBookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * @ORM\OneToMany(targetEntity=BookingDetail::class, mappedBy="booking")
     */
    private $bookingDetails;

    public function __construct()
    {
        $this->bookingDetails = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getSitter(): ?User
    {
        return $this->sitter;
    }

    public function setSitter(?User $sitter): self
    {
        $this->sitter = $sitter;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }


    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return Collection|BookingDetail[]
     */
    public function getBookingDetails(): Collection
    {
        return $this->bookingDetails;
    }

    public function addBookingDetail(BookingDetail $bookingDetail): self
    {
        if (!$this->bookingDetails->contains($bookingDetail)) {
            $this->bookingDetails[] = $bookingDetail;
            $bookingDetail->setBooking($this);
        }

        return $this;
    }

    public function removeBookingDetail(BookingDetail $bookingDetail): self
    {
        if ($this->bookingDetails->removeElement($bookingDetail)) {
            // set the owning side to null (unless already changed)
            if ($bookingDetail->getBooking() === $this) {
                $bookingDetail->setBooking(null);
            }
        }

        return $this;
    }

}
