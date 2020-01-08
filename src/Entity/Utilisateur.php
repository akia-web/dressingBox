<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="utilisateur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Favori", mappedBy="client")
     */
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vetement2", mappedBy="client_id")
     */
    private $vetement2s;

   

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->vetement2s = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection|Favori[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favori $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->setClient($this);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            // set the owning side to null (unless already changed)
            if ($favori->getClient() === $this) {
                $favori->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vetement2[]
     */
    public function getVetement2s(): Collection
    {
        return $this->vetement2s;
    }

    public function addVetement2(Vetement2 $vetement2): self
    {
        if (!$this->vetement2s->contains($vetement2)) {
            $this->vetement2s[] = $vetement2;
            $vetement2->setClientId($this);
        }

        return $this;
    }

    public function removeVetement2(Vetement2 $vetement2): self
    {
        if ($this->vetement2s->contains($vetement2)) {
            $this->vetement2s->removeElement($vetement2);
            // set the owning side to null (unless already changed)
            if ($vetement2->getClientId() === $this) {
                $vetement2->setClientId(null);
            }
        }

        return $this;
    }

}
