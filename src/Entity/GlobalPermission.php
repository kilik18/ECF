<?php

namespace App\Entity;

use App\Repository\GlobalPermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Partner::class, mappedBy: 'globalPermission')]
    private Collection $partners;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?LocalPermission $localPermission = null;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Partner>
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partner $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners->add($partner);
            $partner->addGlobalPermission($this);
        }

        return $this;
    }

    public function removePartner(Partner $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removeGlobalPermission($this);
        }

        return $this;
    }

    public function getLocalPermission(): ?LocalPermission
    {
        return $this->localPermission;
    }

    public function setLocalPermission(?LocalPermission $localPermission): self
    {
        $this->localPermission = $localPermission;

        return $this;
    }
}
