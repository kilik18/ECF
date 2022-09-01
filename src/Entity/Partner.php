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
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $mail = null;

    #[ORM\Column(length: 100)]
    private ?string $password = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $technicalContact = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $commercialContact = null;

    #[ORM\Column]
    private ?bool $activated = null;



    #[ORM\ManyToOne(inversedBy: 'partner')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: GlobalPermission::class)]
    private Collection $globalPermission;

    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: Structure::class, orphanRemoval: true)]
    private Collection $structure;

    public function __construct()
    {
        $this->structure = new ArrayCollection();
        $this->globalPermission = new ArrayCollection();
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
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getTechnicalContact(): ?string
    {
        return $this->technicalContact;
    }

    public function setTechnicalContact(string $technicalContact): self
    {
        $this->technicalContact = $technicalContact;

        return $this;
    }

    public function getCommercialContact(): ?string
    {
        return $this->commercialContact;
    }

    public function setCommercialContact(string $commercialContact): self
    {
        $this->commercialContact = $commercialContact;

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

    /**
     * @return Collection<int, GlobalPermission>
     */
    public function getGlobalPermission(): Collection
    {
        return $this->globalPermission;
    }

    public function addGlobalPermission(GlobalPermission $globalPermission): self
    {
        if (!$this->globalPermission->contains($globalPermission)) {
            $this->globalPermission->add($globalPermission);
            $globalPermission->setPartner($this);
        }

        return $this;
    }

    public function removeGlobalPermission(GlobalPermission $globalPermission): self
    {
        if ($this->globalPermission->removeElement($globalPermission)) {
            // set the owning side to null (unless already changed)
            if ($globalPermission->getPartner() === $this) {
                $globalPermission->setPartner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructure(): Collection
    {
        return $this->structure;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structure->contains($structure)) {
            $this->structure->add($structure);
            $structure->setPartner($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structure->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPartner() === $this) {
                $structure->setPartner(null);
            }
        }

        return $this;
    }
}
