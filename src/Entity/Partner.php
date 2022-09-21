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

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $technicalContact = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $commercialContact = null;

    #[ORM\ManyToMany(targetEntity: GlobalPermission::class, inversedBy: 'partners')]
    private Collection $globalPermission;

    public function __construct()
    {
        $this->globalPermission = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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
        }

        return $this;
    }

    public function removeGlobalPermission(GlobalPermission $globalPermission): self
    {
        $this->globalPermission->removeElement($globalPermission);

        return $this;
    }
}
