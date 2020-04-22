<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeNumeroRepository")
 */
class TypeNumero
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Palier", mappedBy="type", orphanRemoval=true)
     */
    private $paliers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="typNumero")
     */
    private $users;

    public function __construct()
    {
        $this->paliers = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Palier[]
     */
    public function getPaliers(): Collection
    {
        return $this->paliers;
    }


    public function addPalier(Palier $palier): self
    {
        if (!$this->paliers->contains($palier)) {
            $this->paliers[] = $palier;
            $palier->setType($this);
        }

        return $this;
    }

    public function removePalier(Palier $palier): self
    {
        if ($this->paliers->contains($palier)) {
            $this->paliers->removeElement($palier);
            // set the owning side to null (unless already changed)
            if ($palier->getType() === $this) {
                $palier->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setTypNumero($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getTypNumero() === $this) {
                $user->setTypNumero(null);
            }
        }

        return $this;
    }
}
