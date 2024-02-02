<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class ResponseController extends AbstractController
{
    #[Route('/redirect')]
    public function redirectResponse(): Response
    {
        return $this->redirectToRoute('faire-un-render',['a'=>'valeur 1', 'b'=>'valeur 2']);
        #return $this->redirect('/render');
    }

    #[Route('/render/{a}/{b}', name: 'faire-un-render')]
    public function renderResponse(FilmRepository $filmRepository): Response
    {
        $film = $filmRepository->find(6655);

        return $this->render('response/index.html.twig', ['filmTrouve'=>$film]   );
    }

    #[Route('/json')]
    public function jsonResponse(FilmRepository $repository, EntityManagerInterface $entityManager)
    {
        #$film = $entityManager->createQuery('SELECT f.titre, f.annee FROM App:Film f WHERE f.id=6655')->getSingleResult();
        $film = $repository->find(6655);// Reférence circulaire film -> genre -> film

        return $this->json($film);
    }

    #[Route('/response')]
    public function responseResponse(){
        return new Response('COUCOU');// Renvoie du HTML
    }

    #[Route('/binary-file-response')]
    public function fileResponse(){

        return new BinaryFileResponse('../_FICHIERS/kwikhot.PNG');
    }
}
