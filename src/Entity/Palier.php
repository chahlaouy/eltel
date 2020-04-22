<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PalierRepository")
 */
class Palier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", length=255)
     */
    private $palier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeNumero", inversedBy="paliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="palier")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPalier(): ?float
    {
        return $this->palier;
    }

    public function setPalier(float $palier): self
    {
        $this->palier = $palier;

        return $this;
    }

    public function getType(): ?TypeNumero
    {
        return $this->type;
    }

    public function setType(?TypeNumero $type): self
    {
        $this->type = $type;

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
            $user->setPalier($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getPalier() === $this) {
                $user->setPalier(null);
            }
        }

        return $this;
    }
}
