<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=SitterSkill::class, mappedBy="skill")
     */
    private $sitterSkills;

    public function __construct()
    {
        $this->sitterSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $sitterSkill->setSkill($this);
        }

        return $this;
    }

    public function removeSitterSkill(SitterSkill $sitterSkill): self
    {
        if ($this->sitterSkills->removeElement($sitterSkill)) {
            // set the owning side to null (unless already changed)
            if ($sitterSkill->getSkill() === $this) {
                $sitterSkill->setSkill(null);
            }
        }

        return $this;
    }
}
