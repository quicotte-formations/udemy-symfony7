<?php

namespace App\Entity;

use App\Repository\CastingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CastingRepository::class)]
class Casting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'realisateurs')]
    private Collection $filmsRealises;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'acteurs')]
    private Collection $filmsInterpretes;

    public function __construct()
    {
        $this->filmsRealises = new ArrayCollection();
        $this->filmsInterpretes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsRealises(): Collection
    {
        return $this->filmsRealises;
    }

    public function addFilmsRealise(Film $filmsRealise): self
    {
        if (!$this->filmsRealises->contains($filmsRealise)) {
            $this->filmsRealises->add($filmsRealise);
            $filmsRealise->addRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): self
    {
        if ($this->filmsRealises->removeElement($filmsRealise)) {
            $filmsRealise->removeRealisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsInterpretes(): Collection
    {
        return $this->filmsInterpretes;
    }

    public function addFilmsInterprete(Film $filmsInterprete): self
    {
        if (!$this->filmsInterpretes->contains($filmsInterprete)) {
            $this->filmsInterpretes->add($filmsInterprete);
            $filmsInterprete->addActeur($this);
        }

        return $this;
    }

    public function removeFilmsInterprete(Film $filmsInterprete): self
    {
        if ($this->filmsInterpretes->removeElement($filmsInterprete)) {
            $filmsInterprete->removeActeur($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->libelle;
    }
}
