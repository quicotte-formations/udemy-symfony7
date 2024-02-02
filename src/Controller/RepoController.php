<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepoController extends AbstractController
{
    #[Route('/repo')]
    public function index(FilmRepository $repository): Response
    {
        $repository->rechercherFilmHorreur();

        $f = $repository->findOneByTitre("TEST");
        $repository->remove($f, true);
    }
}
