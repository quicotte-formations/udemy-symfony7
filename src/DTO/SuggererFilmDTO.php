<?php

namespace App\DTO;

use App\Kernel;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class SuggererFilmDTO
{
    #[NotBlank]
    #[Length(min: 3)]
    #[Regex(pattern: '/^[A-Z][a-z]{2,}$/')]
    private $titre;

    #[LessThan('today')]
    private $dateDeSortie;

    private $genre;
    private $version;#FR VO VOSTFR
    private $votreMail;

    #[Image(maxSize: '1k')]
    private $fichierJoint;

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     * @return SuggererFilmDTO
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDeSortie()
    {
        return $this->dateDeSortie;
    }

    /**
     * @param mixed $dateDeSortie
     * @return SuggererFilmDTO
     */
    public function setDateDeSortie($dateDeSortie)
    {
        $this->dateDeSortie = $dateDeSortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return SuggererFilmDTO
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return SuggererFilmDTO
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVotreMail()
    {
        return $this->votreMail;
    }

    /**
     * @param mixed $votreMail
     * @return SuggererFilmDTO
     */
    public function setVotreMail($votreMail)
    {
        $this->votreMail = $votreMail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFichierJoint()
    {
        return $this->fichierJoint;
    }

    /**
     * @param mixed $fichierJoint
     * @return SuggererFilmDTO
     */
    public function setFichierJoint($fichierJoint)
    {
        $this->fichierJoint = $fichierJoint;
        return $this;
    }


}