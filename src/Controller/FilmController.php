<?php

namespace App\Controller;

use App\DTO\FiltrerFilmDTO;
use App\Entity\Film;
use App\Form\FilmType;
use App\Form\FiltrerFilmsType;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/liste-films', name: 'liste-films', methods: ['GET', 'POST'])]
    public function lister(FilmRepository $filmRepository, Request $request): Response
    {
        $qb = $filmRepository->createQueryBuilder('f')
            ->orderBy('f.annee', 'ASC')
            ->addOrderBy('f.titre', 'ASC');

        $dto = new FiltrerFilmDTO();
        $form = $this->createForm(FiltrerFilmsType::class, $dto);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($dto->getGenre()){

                $qb ->join('f.genres', 'g')
                    ->andWhere('g = :GENRE')->setParameter('GENRE', $dto->getGenre());
            }
            if($dto->getAnneeDebut()){

                $qb->andWhere('f.annee>=:ANNEE_DEBUT')->setParameter('ANNEE_DEBUT', $dto->getAnneeDebut());
            }
            if($dto->getAnneeFin()){

                $qb->andWhere('f.annee<=:ANNEE_FIN')->setParameter('ANNEE_FIN', $dto->getAnneeFin());
            }
        }else{
            $qb->setMaxResults(10);
        }

        return $this->render('film/index.html.twig', [
            'films' => $qb->getQuery()->getResult(),
            'form' => $form
        ]);
    }

    #[Route('/film/detail/{id}', methods: ['GET'], name: 'detail-film')]
    public function detail(Film $film){

        dump( $film );
    }

    #[Route('/film/detail/{idA}/{idB}', methods: ['GET'], name: 'detail-film')]
    public function f3($idA, $idB){

        dump( $idA );
        dump( $idB );
    }
}
