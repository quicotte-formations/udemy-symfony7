<?php

namespace App\Controller;

use App\DTO\SuggererFilmDTO;
use App\Form\SuggererFilmType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulairesController extends AbstractController
{
    #[Route('/formulaires/suggerer', name: 'app_formulaires')]
    public function index(Request $request): Response
    {
        $dto = new SuggererFilmDTO();
        $form = $this->createForm(SuggererFilmType::class, $dto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $form['fichierJoint']->getData();
            $nomFichier = uniqid() . '.' . $file->guessExtension();
            $file->move('images', $nomFichier);
        }

        return $this->render('formulaires/index.html.twig', [
            'form' => $form,
        ]);
    }
}
