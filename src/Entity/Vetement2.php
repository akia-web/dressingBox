<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;


/**
 * @ORM\Entity(repositoryClass="App\Repository\Vetement2Repository")
 * @Vich\Uploadable()
 */
class Vetement2
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="vetement2s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $style;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?Utilisateur
    {
        return $this->client_id;
    }

    public function setClientId(?Utilisateur $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }



//         //   ** PHOTO **
//     /**
//      * @return null|string
//      */
//     public function getFilename(): ?string
//     {
//         return $this->filename;
//     }
//     /**
//      * @param null|string $filename
//      * @return Vetement2
//      * @throws \Exception
//      */
//     public function setFilename(?string $filename): Vetement2
//     {
//         $this->filename = $filename;
//         return $this;
//     }
//     /**
//      * @return null|File
//      */
//     public function getImageFile(): ?File
//     {
//         return $this->imageFile;
//     }
//     /**
//      * @param File|null $imageFile
//      * @return Vetement2
//      * @throws \Exception
//      */
//     public function setImageFile(?File $imageFile): Vetement2
//     {
//         $this->imageFile = $imageFile;
//         if ($this->imageFile instanceof UploadedFile) {
//             $this->updated_at = new \DateTime('now');
//         }
//             return $this;
//     }
//     public function getUpdatedAt(): ?\DateTimeInterface
//     {
//         return $this->updated_at;
//     }
//     public function setUpdatedAt(\DateTimeInterface $updated_at): self
//     {
//         $this->updated_at = $updated_at;
//         return $this;
//     }


  
    
 }
