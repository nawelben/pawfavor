<?php

namespace App\Entity;

use App\Repository\SitterSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SitterSkillRepository::class)
 */
class SitterSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sitterSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sitter;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="sitterSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }
}
