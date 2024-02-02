<?php

namespace App\DTO;

class FiltrerFilmDTO
{
    private $genre;
    private $pays;
    private $anneeDebut;
    private $anneeFin;
    private $titre;

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays): void
    {
        $this->pays = $pays;
    }

    /**
     * @return mixed
     */
    public function getAnneeDebut()
    {
        return $this->anneeDebut;
    }

    /**
     * @param mixed $anneeDebut
     */
    public function setAnneeDebut($anneeDebut): void
    {
        $this->anneeDebut = $anneeDebut;
    }

    /**
     * @return mixed
     */
    public function getAnneeFin()
    {
        return $this->anneeFin;
    }

    /**
     * @param mixed $anneeFin
     */
    public function setAnneeFin($anneeFin): void
    {
        $this->anneeFin = $anneeFin;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }


}