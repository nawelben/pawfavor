<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="Pet", mappedBy="user")
     */
    protected $pets;

    /**
     * @ORM\OneToMany(targetEntity=Disponibility::class, mappedBy="sitter")
     */
    private $disponibilities;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="sitter")
     */
    private $sitterReviews;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="owner")
     */
    private $ownerReviews;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="sitter")
     */
    private $sitterBookings;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="owner")
     */
    private $ownerBookings;

    /**
     * @ORM\OneToMany(targetEntity=SitterSkill::class, mappedBy="sitter")
     */
    private $sitterSkills;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="sitter")
     */
    private $sitterPayments;

    /**
     * @ORM\OneToMany(targetEntity=SitterLanguage::class, mappedBy="sitter")
     */
    private $sitterLanguages;

    /**
     * @ORM\OneToMany(targetEntity=SavedSitters::class, mappedBy="owner")
     */
    private $savedSitters;

    /**
     * @ORM\OneToOne(targetEntity=OwnerAbout::class, mappedBy="owner", cascade={"persist", "remove"})
     */
    private $ownerAbout;

    /**
     * @ORM\OneToOne(targetEntity=SitterAbout::class, mappedBy="sitter", cascade={"persist", "remove"})
     */
    private $sitterAbout;

    /**
     * @ORM\OneToMany(targetEntity=SitterServicePrice::class, mappedBy="sitter")
     */
    private $sitterServicePrices;

    /**
     * @ORM\OneToOne(targetEntity=SitterHome::class, mappedBy="sitter", cascade={"persist", "remove"})
     */
    private $sitterHome;

    public function __construct()
    {
        $this->pets = new ArrayCollection();
        $this->disponibilities = new ArrayCollection();
        $this->sitterReviews = new ArrayCollection();
        $this->ownerReviews = new ArrayCollection();
        $this->sitterBookings = new ArrayCollection();
        $this->ownerBookings = new ArrayCollection();
        $this->sitterSkills = new ArrayCollection();
        $this->sitterPayments = new ArrayCollection();
        $this->sitterLanguages = new ArrayCollection();
        $this->savedSitters = new ArrayCollection();
        $this->sitterServicePrices = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Pet[]
     */
    public function getPets(): Collection
    {
        return $this->pets;
    }

    public function addPet(Pet $pet): self
    {
        if (!$this->pets->contains($pet)) {
            $this->pets[] = $pet;
            $pet->setUser($this);
        }

        return $this;
    }

    public function removePet(Pet $pet): self
    {
        if ($this->pets->removeElement($pet)) {
            // set the owning side to null (unless already changed)
            if ($pet->getUser() === $this) {
                $pet->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Disponibility[]
     */
    public function getDisponibilities(): Collection
    {
        return $this->disponibilities;
    }

    public function addDisponibility(Disponibility $disponibility): self
    {
        if (!$this->disponibilities->contains($disponibility)) {
            $this->disponibilities[] = $disponibility;
            $disponibility->setSitter($this);
        }

        return $this;
    }

    public function removeDisponibility(Disponibility $disponibility): self
    {
        if ($this->disponibilities->removeElement($disponibility)) {
            // set the owning side to null (unless already changed)
            if ($disponibility->getSitter() === $this) {
                $disponibility->setSitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getSitterReviews(): Collection
    {
        return $this->sitterReviews;
    }

    public function addSitterReview(Review $sitterReview): self
    {
        if (!$this->sitterReviews->contains($sitterReview)) {
            $this->sitterReviews[] = $sitterReview;
            $sitterReview->setSitter($this);
        }

        return $this;
    }

    public function removeSitterReview(Review $sitterReview): self
    {
        if ($this->sitterReviews->removeElement($sitterReview)) {
            // set the owning side to null (unless already changed)
            if ($sitterReview->getSitter() === $this) {
                $sitterReview->setSitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getOwnerReviews(): Collection
    {
        return $this->ownerReviews;
    }

    public function addOwnerReview(Review $ownerReview): self
    {
        if (!$this->ownerReviews->contains($ownerReview)) {
            $this->ownerReviews[] = $ownerReview;
            $ownerReview->setOwner($this);
        }

        return $this;
    }

    public function removeOwnerReview(Review $ownerReview): self
    {
        if ($this->ownerReviews->removeElement($ownerReview)) {
            // set the owning side to null (unless already changed)
            if ($ownerReview->getOwner() === $this) {
                $ownerReview->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getSitterBooking(): Collection
    {
        return $this->sitterBookings;
    }

    public function addSitterBooking(Booking $sitterBookings): self
    {
        if (!$this->sitterBookings->contains($sitterBookings)) {
            $this->sitterBookings[] = $sitterBookings;
            $sitterBookings->setSitter($this);
        }

        return $this;
    }

    public function removeSitterBooking(Booking $sitterBookings): self
    {
        if ($this->sitterBookings->removeElement($sitterBookings)) {
            // set the owning side to null (unless already changed)
            if ($sitterBookings->getSitter() === $this) {
                $sitterBookings->setSitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getOwnerBookings(): Collection
    {
        return $this->ownerBookings;
    }

    public function addOwnerBooking(Booking $ownerBooking): self
    {
        if (!$this->ownerBookings->contains($ownerBooking)) {
            $this->ownerBookings[] = $ownerBooking;
            $ownerBooking->setOwner($this);
        }

        return $this;
    }

    public function removeOwnerBooking(Booking $ownerBooking): self
    {
        if ($this->ownerBookings->removeElement($ownerBooking)) {
            // set the owning side to null (unless already changed)
            if ($ownerBooking->getOwner() === $this) {
                $ownerBooking->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SitterSkill[]
     */
    public function getSitterSkills(): Collection
    {
        return $this->sitterSkills;
    }

    public function addSitterSkill(SitterSkill $sitterSkill): self
    {
        if (!$this->sitterSkills->contains($sitterSkill)) {
            $this->sitterSkills[] = $sitterSkill;
            $sitterSkill->setSitter($this);
        }

        return $this;
    }

    public function removeSitterSkill(SitterSkill $sitterSkill): self
    {
        if ($this->sitterSkills->removeElement($sitterSkill)) {
            // set the owning side to null (unless already changed)
            if ($sitterSkill->getSitter() === $this) {
                $sitterSkill->setSitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function sitterPayments(): Collection
    {
        return $this->sitterPayments;
    }

    public function addSitterPayment(Payment $sitterPayment): self
    {
        if (!$this->sitterPayments->contains($sitterPayment)) {
            $this->sitterPayments[] = $sitterPayment;
            $sitterPayment->setSitter($this);
        }

        return $this;
    }

    public function removeSitterPayment(Payment $sitterPayment): self
    {
        if ($this->sitterPayments->removeElement($sitterPayment)) {
            // set the owning side to null (unless already changed)
            if ($sitterPayment->getSitter() === $this) {
                $sitterPayment->setSitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SitterLanguage[]
     */
    public function getSitterLanguages(): Collection
    {
        return $this->sitterLanguages;
    }

    public function addSitterLanguage(SitterLanguage $sitterLanguage): self
    {
        if (!$this->sitterLanguages->contains($sitterLanguage)) {
            $this->sitterLanguages[] = $sitterLanguage;
            $sitterLanguage->setSitter($this);
        }

        return $this;
    }

    public function removeSitterLanguage(SitterLanguage $sitterLanguage): self
    {
        if ($this->sitterLanguages->removeElement($sitterLanguage)) {
            // set the owning side to null (unless already changed)
            if ($sitterLanguage->getSitter() === $this) {
                $sitterLanguage->setSitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getSitterBookings(): Collection
    {
        return $this->sitterBookings;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getSitterPayments(): Collection
    {
        return $this->sitterPayments;
    }

    /**
     * @return Collection|SavedSitters[]
     */
    public function getSavedSitters(): Collection
    {
        return $this->savedSitters;
    }

    public function addSavedSitter(SavedSitters $savedSitter): self
    {
        if (!$this->savedSitters->contains($savedSitter)) {
            $this->savedSitters[] = $savedSitter;
            $savedSitter->setOwner($this);
        }

        return $this;
    }

    public function removeSavedSitter(SavedSitters $savedSitter): self
    {
        if ($this->savedSitters->removeElement($savedSitter)) {
            // set the owning side to null (unless already changed)
            if ($savedSitter->getOwner() === $this) {
                $savedSitter->setOwner(null);
            }
        }

        return $this;
    }

    public function getOwnerAbout(): ?OwnerAbout
    {
        return $this->ownerAbout;
    }

    public function setOwnerAbout(OwnerAbout $ownerAbout): self
    {
        // set the owning side of the relation if necessary
        if ($ownerAbout->getOwner() !== $this) {
            $ownerAbout->setOwner($this);
        }

        $this->ownerAbout = $ownerAbout;

        return $this;
    }

    public function getSitterAbout(): ?SitterAbout
    {
        return $this->sitterAbout;
    }

    public function setSitterAbout(SitterAbout $sitterAbout): self
    {
        // set the owning side of the relation if necessary
        if ($sitterAbout->getSitter() !== $this) {
            $sitterAbout->setSitter($this);
        }

        $this->sitterAbout = $sitterAbout;

        return $this;
    }

    /**
     * @return Collection|SitterServicePrice[]
     */
    public function getSitterServicePrices(): Collection
    {
        return $this->sitterServicePrices;
    }

    public function addSitterServicePrice(SitterServicePrice $sitterServicePrice): self
    {
        if (!$this->sitterServicePrices->contains($sitterServicePrice)) {
            $this->sitterServicePrices[] = $sitterServicePrice;
            $sitterServicePrice->setSitter($this);
        }

        return $this;
    }

    public function removeSitterServicePrice(SitterServicePrice $sitterServicePrice): self
    {
        if ($this->sitterServicePrices->removeElement($sitterServicePrice)) {
            // set the owning side to null (unless already changed)
            if ($sitterServicePrice->getSitter() === $this) {
                $sitterServicePrice->setSitter(null);
            }
        }

        return $this;
    }

    public function getSitterHome(): ?SitterHome
    {
        return $this->sitterHome;
    }

    public function setSitterHome(SitterHome $sitterHome): self
    {
        // set the owning side of the relation if necessary
        if ($sitterHome->getSitter() !== $this) {
            $sitterHome->setSitter($this);
        }

        $this->sitterHome = $sitterHome;

        return $this;
    }
}
