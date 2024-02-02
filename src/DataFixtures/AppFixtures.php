<?php

namespace App\DataFixtures;

use App\Entity\Casting;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Pays;
use App\Repository\FilmRepository;
use App\Repository\PaysRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        # Ajout genres
        $genreFantastique = new Genre();
        $genreFantastique->setNom("Fantastique");
        $manager->persist($genreFantastique);

        $genreAction = new Genre();
        $genreAction->setNom("Action");
        $manager->persist($genreAction);

        # Ajout pays
        $paysJapon = new Pays();
        $paysJapon->setNom("Japon");
        $manager->persist($paysJapon);

        $paysAllemagne = new Pays();
        $paysAllemagne->setNom("Allemagne");
        $manager->persist($paysAllemagne);

        # Ajout castings
        $castingMurnau = new Casting();
        $castingMurnau->setLibelle("Friedrich Murnau");
        $manager->persist($castingMurnau);

        $castingAkiraKurosawa = new Casting();
        $castingAkiraKurosawa->setLibelle("Akira Kurosawa");
        $manager->persist($castingAkiraKurosawa);

        # Ajout films
        $film = new Film();
        $film->setTitre("Nosferatu")->setAnnee(1922)->setDuree(94)->setSynopsis("Blabla")
            ->addGenre( $genreFantastique )
            ->addPay( $paysAllemagne )
            ->addRealisateur( $castingMurnau );
        $manager->persist($film);

        $film = new Film();
        $film->setTitre("Les Bas-Fonds")->setAnnee(1957)->setDuree(137)->setSynopsis("Blabla")
            ->addGenre( $genreAction )
            ->addPay( $paysJapon )
            ->addRealisateur( $castingAkiraKurosawa );
        $manager->persist($film);

        $film = new Film();
        $film->setTitre("Entre le ciel et l'enfer")->setAnnee(1963)->setDuree(143)->setSynopsis("Blabla")
            ->addGenre( $genreAction )
            ->addGenre( $genreFantastique )
            ->addPay( $paysJapon )
            ->addRealisateur( $castingAkiraKurosawa );
        $manager->persist($film);

        $manager->flush();
    }
}
