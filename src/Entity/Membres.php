<?php

namespace App\Entity;

use App\Repository\MembresRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: MembresRepository::class)]
class Membres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Statut = null;

    #[ORM\Column(length: 255)]
    private ?string $PhotoName = null;

    private ?File $PhotoFile;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'ID_Emprunteur', cascade: ['persist', 'remove'])]
    private ?Livre $livre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getPhotoName(): ?string
    {
        return $this->PhotoName;
    }

    public function setPhotoName(?string $Photo): static
    {
        $this->PhotoName = $Photo;

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

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): static
    {
        // unset the owning side of the relation if necessary
        if ($livre === null && $this->livre !== null) {
            $this->livre->setIDEmprunteur(null);
        }

        // set the owning side of the relation if necessary
        if ($livre !== null && $livre->getIDEmprunteur() !== $this) {
            $livre->setIDEmprunteur($this);
        }

        $this->livre = $livre;

        return $this;
    }
}
