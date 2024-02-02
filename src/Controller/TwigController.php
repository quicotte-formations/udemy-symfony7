<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/twig')]
class TwigController extends AbstractController
{
    #[Route('/test')]
    public function test(FilmRepository $filmRepository): Response
    {
        return $this->render('twig/test.html.twig', ['dateJour'=>new \DateTime()]);
    }

    #[Route('/lister-films')]
    public function inclusion(FilmRepository $filmRepository): Response
    {
        $filmsTrouves = $filmRepository->findBy([],[],10);

        return $this->render('twig/lister-films.html.twig', ['films'=>$filmsTrouves]);
    }

    #[Route('/detail-film/{id}')]
    public function inclusionB($id, FilmRepository $filmRepository): Response
    {
        return $this->render('twig/include-detail-film.twig', ['film'=>$filmRepository->find($id)]);
    }
}
