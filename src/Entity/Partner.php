<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $partner_name = null;

    #[ORM\Column(length: 100)]
    private ?string $partner_mail = null;

    #[ORM\Column(length: 100)]
    private ?string $partner_password = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $technical_contact = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $commercial_contact = null;

    #[ORM\Column]
    private ?bool $activated = null;

    #[ORM\ManyToOne(inversedBy: 'partners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: Structure::class, orphanRemoval: true)]
    private Collection $structures;

    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: GlobalPermission::class, orphanRemoval: true)]
    private Collection $globalPermissions;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
        $this->globalPermissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartnerName(): ?string
    {
        return $this->partner_name;
    }

    public function setPartnerName(string $partner_name): self
    {
        $this->partner_name = $partner_name;

        return $this;
    }

    public function getPartnerMail(): ?string
    {
        return $this->partner_mail;
    }

    public function setPartnerMail(string $partner_mail): self
    {
        $this->partner_mail = $partner_mail;

        return $this;
    }

    public function getPartnerPassword(): ?string
    {
        return $this->partner_password;
    }

    public function setPartnerPassword(string $partner_password): self
    {
        $this->partner_password = $partner_password;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

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

    public function getTechnicalContact(): ?string
    {
        return $this->technical_contact;
    }

    public function setTechnicalContact(string $technical_contact): self
    {
        $this->technical_contact = $technical_contact;

        return $this;
    }

    public function getCommercialContact(): ?string
    {
        return $this->commercial_contact;
    }

    public function setCommercialContact(string $commercial_contact): self
    {
        $this->commercial_contact = $commercial_contact;

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

    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setPartner($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPartner() === $this) {
                $structure->setPartner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GlobalPermission>
     */
    public function getGlobalPermissions(): Collection
    {
        return $this->globalPermissions;
    }

    public function addGlobalPermission(GlobalPermission $globalPermission): self
    {
        if (!$this->globalPermissions->contains($globalPermission)) {
            $this->globalPermissions->add($globalPermission);
            $globalPermission->setPartner($this);
        }

        return $this;
    }

    public function removeGlobalPermission(GlobalPermission $globalPermission): self
    {
        if ($this->globalPermissions->removeElement($globalPermission)) {
            // set the owning side to null (unless already changed)
            if ($globalPermission->getPartner() === $this) {
                $globalPermission->setPartner(null);
            }
        }

        return $this;
    }
}
