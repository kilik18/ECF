<?php

namespace App\Entity;

use App\Repository\LocalPermissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalPermissionRepository::class)]
class LocalPermission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $activated = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?GlobalPermission $globalPermission = null;

    #[ORM\ManyToOne(inversedBy: 'localPermission')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Structure $structure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }


    public function getGlobalPermission(): ?GlobalPermission
    {
        return $this->globalPermission;
    }

    public function setGlobalPermission(GlobalPermission $globalPermission): self
    {
        $this->globalPermission = $globalPermission;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }
}
