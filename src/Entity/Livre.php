<?php 

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[
    ORM\Entity(repositoryClass: LivreRepository::class)
]
class Livre
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
    private ?string $Titre = null;

    #[
        ORM\Column(type: "string", length: 255)
    ]
    private ?string $Auteur = null;

    #[
        ORM\Column(type: "string", length: 500, nullable: true)
    ]
    private ?string $Description = null;

    #[
        ORM\Column(type: "integer")
    ]
    private ?int $Date_de_Paruption = null;

    #[
        ORM\Column(type: "string", length: 255, nullable: true)
    ]
    private ?string $ImageName = null;

    private ?File $ImageFile;

    #[
        ORM\Column(type: "datetime_immutable", nullable: true)
    ]
    private ?\DateTimeImmutable $updatedAt = null;

    #[
        ORM\Column(type: "string", length: 255, nullable: true)
    ]
    private ?string $Pages_Nombres = null;

    #[
        ORM\Column(type: "string", length: 255)
    ]
    private ?string $Categorie = null;

    #[
        ORM\Column(type: "boolean")
    ]
    private ?bool $Statut = null;

    #[
        ORM\Column(type: "integer")
    ]
    private ?int $ISBN_Nombre = null;


    #[
        ORM\ManyToOne(inversedBy: "livres", cascade: ["persist", "remove"])
    ]

    private ?Membres $ID_Emprunteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): static
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateDeParuption(): ?int
    {
        return $this->Date_de_Paruption;
    }

    public function setDateDeParuption(int $Date_de_Paruption): static
    {
        $this->Date_de_Paruption = $Date_de_Paruption;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->ImageName;
    }

    public function setImageName(?string $Image): static
    {
        $this->ImageName = $Image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->ImageFile;
    }

    public function setImageFile(?File $ImageFile = null): void
    {
        $this->ImageFile = $ImageFile;

        if ($ImageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPagesNombres(): ?string
    {
        return $this->Pages_Nombres;
    }

    public function setPagesNombres(?string $Pages_Nombres): static
    {
        $this->Pages_Nombres = $Pages_Nombres;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->Statut;
    }

    public function setStatut(bool $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getISBNNombre(): ?int
    {
        return $this->ISBN_Nombre;
    }

    public function setISBNNombre(int $ISBN_Nombre): static
    {
        $this->ISBN_Nombre = $ISBN_Nombre;

        return $this;
    }

  
    public function getIDEmprunteur(): ?Membres
    {
        return $this->ID_Emprunteur;
    }

    public function setIDEmprunteur(?Membres $ID_Emprunteur): self
    {
        $this->ID_Emprunteur = $ID_Emprunteur;

        return $this;
    }
}
