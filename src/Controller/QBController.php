<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QBController extends AbstractController
{
    /**
     * Le nombre et la durée moyenne de films pour chaque genre, triés par quantité décroissante
     */
    #[Route('/qb3')]
    public function qb3(GenreRepository $genreRepository): Response
    {
        $qb = $genreRepository->createQueryBuilder('g')
            ->select('g.nom nom_genre, COUNT(f) nb_films, AVG(f.duree) duree_moy')
            ->join('g.films', 'f')
            ->groupBy('g')
            ->orderBy('nb_films', 'DESC');

        $query = $qb->getQuery();

        dump( $query->getResult() );
    }

    /**
     * Les films d'action
     */
    #[Route('/qb2')]
    public function qb2(FilmRepository $filmRepository): Response
    {
        $qb = $filmRepository->createQueryBuilder('f')
            ->join('f.genres', 'g')
            ->andWhere('g.nom=:ACTION')
            ->setParameter('ACTION', 'Action');

        $query = $qb->getQuery();

        dump( $query->getResult() );
    }

    /**
     * Les pays, triés par ordre alphabétique
     */
    #[Route('/qb1')]
    public function qb1(EntityManagerInterface $entityManager): Response
    {
        $qb = $entityManager->createQueryBuilder();
        $qb->from('App:Pays', 'p')
            ->select('p')
            ->orderBy('p.nom', 'ASC');

        $query = $qb->getQuery();

        dump( $query->getResult() );
    }
}
