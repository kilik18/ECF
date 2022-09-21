<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $street = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\ManyToMany(targetEntity: LocalPermission::class, inversedBy: 'structures')]
    private Collection $localPermission;

    public function __construct()
    {
        $this->localPermission = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * @return Collection<int, LocalPermission>
     */
    public function getLocalPermission(): Collection
    {
        return $this->localPermission;
    }

    public function addLocalPermission(LocalPermission $localPermission): self
    {
        if (!$this->localPermission->contains($localPermission)) {
            $this->localPermission->add($localPermission);
        }

        return $this;
    }

    public function removeLocalPermission(LocalPermission $localPermission): self
    {
        $this->localPermission->removeElement($localPermission);

        return $this;
    }
}
