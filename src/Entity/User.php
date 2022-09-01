<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $lastname = null;


    #[ORM\OneToMany(mappedBy: 'user', targetEntity: GlobalPermission::class)]
    private Collection $GlobalPermission;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Structure::class)]
    private Collection $structure;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Partner::class, orphanRemoval: true)]
    private Collection $partner;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
        $this->GlobalPermission = new ArrayCollection();
        $this->structure = new ArrayCollection();
        $this->partner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }


    /**
     * @return Collection<int, GlobalPermission>
     */
    public function getGlobalPermission(): Collection
    {
        return $this->GlobalPermission;
    }

    public function addGlobalPermission(GlobalPermission $globalPermission): self
    {
        if (!$this->GlobalPermission->contains($globalPermission)) {
            $this->GlobalPermission->add($globalPermission);
            $globalPermission->setUser($this);
        }

        return $this;
    }

    public function removeGlobalPermission(GlobalPermission $globalPermission): self
    {
        if ($this->GlobalPermission->removeElement($globalPermission)) {
            // set the owning side to null (unless already changed)
            if ($globalPermission->getUser() === $this) {
                $globalPermission->setUser(null);
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
            $structure->setUser($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structure->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getUser() === $this) {
                $structure->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partner>
     */
    public function getPartner(): Collection
    {
        return $this->partner;
    }

    public function addPartner(Partner $partner): self
    {
        if (!$this->partner->contains($partner)) {
            $this->partner->add($partner);
            $partner->setUser($this);
        }

        return $this;
    }

    public function removePartner(Partner $partner): self
    {
        if ($this->partner->removeElement($partner)) {
            // set the owning side to null (unless already changed)
            if ($partner->getUser() === $this) {
                $partner->setUser(null);
            }
        }

        return $this;
    }
}
