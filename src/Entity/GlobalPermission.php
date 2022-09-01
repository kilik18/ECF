<?php

namespace App\Entity;

use App\Repository\GlobalPermissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlobalPermissionRepository::class)]
class GlobalPermission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $activated = null;


    #[ORM\ManyToOne(inversedBy: 'GlobalPermission')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'globalPermission')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partner $partner = null;


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


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }
}

