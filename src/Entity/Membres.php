<?php

namespace App\Entity;

use App\Repository\MembresRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[
    ORM\Entity(repositoryClass: MembresRepository::class)
]
class Membres
{
    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: "integer")
    ]
    private ?int $id = null;

    #[
        ORM\Column(type: "string", length: 255)
    ]
    private ?string $Nom = null;

    #[
        ORM\Column(type: "string", length: 255)
    ]
    private ?string $Prenom = null;

    #[
        ORM\Column(type: "string", length: 255)
    ]
    private ?string $Statut = null;

    #[
        ORM\Column(type: "string", length: 255, nullable: true)
    ]
    private ?string $PhotoName = null;

    private ?File $PhotoFile;

    #[
        ORM\Column(type: "datetime_immutable", nullable: true)
    ]
    private ?\DateTimeImmutable $updatedAt = null;

    #[
        ORM\OneToMany(mappedBy: "ID_Emprunteur", targetEntity: Livre::class, cascade: ["persist", "remove"])
    ]
    private Collection $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getPhotoName(): ?string
    {
        return $this->PhotoName;
    }

    public function setPhotoName(?string $PhotoName): self
    {
        $this->PhotoName = $PhotoName;

        return $this;
    }

    public function getPhotoFile(): ?File
    {
        return $this->PhotoFile;
    }

    public function setPhotoFile(?File $PhotoFile = null): void
    {
        $this->PhotoFile = $PhotoFile;

        if ($PhotoFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->setIDEmprunteur($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getIDEmprunteur() === $this) {
                $livre->setIDEmprunteur(null);
            }
        }

        return $this;
    }
}
