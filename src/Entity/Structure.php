<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $structure_name = null;

    #[ORM\Column(length: 100)]
    private ?string $structure_mail = null;

    #[ORM\Column(length: 100)]
    private ?string $structure_password = null;

    #[ORM\Column(length: 100)]
    private ?string $manager_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column]
    private ?bool $activated = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partner $partner = null;

    #[ORM\OneToMany(mappedBy: 'structure', targetEntity: LocalPermission::class, orphanRemoval: true)]
    private Collection $localPermissions;

    public function __construct()
    {
        $this->localPermissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStructureName(): ?string
    {
        return $this->structure_name;
    }

    public function setStructureName(string $structure_name): self
    {
        $this->structure_name = $structure_name;

        return $this;
    }

    public function getStructureMail(): ?string
    {
        return $this->structure_mail;
    }

    public function setStructureMail(string $structure_mail): self
    {
        $this->structure_mail = $structure_mail;

        return $this;
    }

    public function getStructurePassword(): ?string
    {
        return $this->structure_password;
    }

    public function setStructurePassword(string $structure_password): self
    {
        $this->structure_password = $structure_password;

        return $this;
    }

    public function getManagerName(): ?string
    {
        return $this->manager_name;
    }

    public function setManagerName(string $manager_name): self
    {
        $this->manager_name = $manager_name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

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

    /**
     * @return Collection<int, LocalPermission>
     */
    public function getLocalPermissions(): Collection
    {
        return $this->localPermissions;
    }

    public function addLocalPermission(LocalPermission $localPermission): self
    {
        if (!$this->localPermissions->contains($localPermission)) {
            $this->localPermissions->add($localPermission);
            $localPermission->setStructure($this);
        }

        return $this;
    }

    public function removeLocalPermission(LocalPermission $localPermission): self
    {
        if ($this->localPermissions->removeElement($localPermission)) {
            // set the owning side to null (unless already changed)
            if ($localPermission->getStructure() === $this) {
                $localPermission->setStructure(null);
            }
        }

        return $this;
    }
}
