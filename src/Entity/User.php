<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email existe deja")
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="4", minMessage="Votre mot de passe doit faire minimum 8 caractéres")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    private $email;
    /**
     * @Assert\EqualTo(propertyPath="password", message="les mots de passes ne sont pas identiques")
     */
    private $confirmPaswword;

    public function getConfirmPaswword(): ?string
    {
        return $this->confirmPaswword;
    }

    public function setConfirmPaswword(string $confirmPaswword): self
    {
        $this->confirmPaswword = $confirmPaswword;

        return $this;
    }

    public $numberType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->username;
    }

    public function setUserName(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return (Role|string)[] The user roles
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeNumero", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typNumero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Palier", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $palier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $identity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verified;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Identity", mappedBy="user", cascade={"persist", "remove"})
     */
    private $userIdentity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NumeroSurtaxe", mappedBy="user")
     */
    private $numeroSurtaxes;

    public function __construct()
    {
        $this->numeroSurtaxes = new ArrayCollection();
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

     /**
     * @return string|null The salt
     */
    public function getSalt(){

        return null;
    }

     /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(){}

    public function serialize(){
        
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->roles
        ]);
    }

    public function unserialize($serialized){
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->roles
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTypNumero(): ?TypeNumero
    {
        return $this->typNumero;
    }

    public function setTypNumero(?TypeNumero $typNumero): self
    {
        $this->typNumero = $typNumero;

        return $this;
    }

    public function getPalier(): ?Palier
    {
        return $this->palier;
    }

    public function setPalier(?Palier $palier): self
    {
        $this->palier = $palier;

        return $this;
    }

    public function getIdentity(): ?string
    {
        return $this->identity;
    }

    public function setIdentity(?string $identity): self
    {
        $this->identity = $identity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    public function getUserIdentity(): ?Identity
    {
        return $this->userIdentity;
    }

    public function setUserIdentity(?Identity $userIdentity): self
    {
        $this->userIdentity = $userIdentity;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $userIdentity ? null : $this;
        if ($userIdentity->getUser() !== $newUser) {
            $userIdentity->setUser($newUser);
        }

        return $this;
    }

    /**
     * @return Collection|NumeroSurtaxe[]
     */
    public function getNumeroSurtaxes(): Collection
    {
        return $this->numeroSurtaxes;
    }

    public function addNumeroSurtax(NumeroSurtaxe $numeroSurtax): self
    {
        if (!$this->numeroSurtaxes->contains($numeroSurtax)) {
            $this->numeroSurtaxes[] = $numeroSurtax;
            $numeroSurtax->setUser($this);
        }

        return $this;
    }

    public function removeNumeroSurtax(NumeroSurtaxe $numeroSurtax): self
    {
        if ($this->numeroSurtaxes->contains($numeroSurtax)) {
            $this->numeroSurtaxes->removeElement($numeroSurtax);
            // set the owning side to null (unless already changed)
            if ($numeroSurtax->getUser() === $this) {
                $numeroSurtax->setUser(null);
            }
        }

        return $this;
    }
}
