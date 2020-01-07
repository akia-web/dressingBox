<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriRepository")
 */
class Favori
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="favoris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vetements", inversedBy="favoris")
     */
    private $vetement;

    public function __construct()
    {
        $this->vetement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Utilisateur
    {
        return $this->client;
    }

    public function setClient(?Utilisateur $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Vetements[]
     */
    public function getVetement(): Collection
    {
        return $this->vetement;
    }

    public function addVetement(Vetements $vetement): self
    {
        if (!$this->vetement->contains($vetement)) {
            $this->vetement[] = $vetement;
        }

        return $this;
    }

    public function removeVetement(Vetements $vetement): self
    {
        if ($this->vetement->contains($vetement)) {
            $this->vetement->removeElement($vetement);
        }

        return $this;
    }
}
