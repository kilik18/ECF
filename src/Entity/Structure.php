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
    private ?string $address = null;

    #[ORM\Column(length: 100)]
    private ?string $mail = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $manager_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column]
    private ?bool $activated = null;



    #[ORM\ManyToOne(inversedBy: 'structure')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'structure')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partner $partner = null;

    #[ORM\OneToMany(mappedBy: 'structure', targetEntity: LocalPermission::class)]
    private Collection $localPermission;



    public function __construct()
    {
        $this->localPermission = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

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
            $localPermission->setStructure($this);
        }

        return $this;
    }

    public function removeLocalPermission(LocalPermission $localPermission): self
    {
        if ($this->localPermission->removeElement($localPermission)) {
            // set the owning side to null (unless already changed)
            if ($localPermission->getStructure() === $this) {
                $localPermission->setStructure(null);
            }
        }

        return $this;
    }
}
