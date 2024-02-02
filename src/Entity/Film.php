<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(nullable: true)]
    private ?int $annee = null;

    #[ORM\Column(nullable: true)]
    private ?int $duree = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $synopsis = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'films')]
    private Collection $genres;

    #[ORM\ManyToMany(targetEntity: Pays::class, inversedBy: 'films')]
    private Collection $pays;

    #[ORM\ManyToMany(targetEntity: Casting::class, inversedBy: 'filmsRealises')]
    #[ORM\JoinTable(name: "real_film")]
    private Collection $realisateurs;

    #[ORM\ManyToMany(targetEntity: Casting::class, inversedBy: 'filmsInterpretes')]
    #[ORM\JoinTable(name: "acteur_film")]
    private Collection $acteurs;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->pays = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): self
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
        }

        return $this;
    }

    public function removePay(Pays $pay): self
    {
        $this->pays->removeElement($pay);

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Casting $realisateur): self
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs->add($realisateur);
        }

        return $this;
    }

    public function removeRealisateur(Casting $realisateur): self
    {
        $this->realisateurs->removeElement($realisateur);

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Casting $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs->add($acteur);
        }

        return $this;
    }

    public function removeActeur(Casting $acteur): self
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }

    public function __toString(): string
    {
        return $this->titre;
    }
}
