<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookiesController extends AbstractController
{
    #[Route('/cookie/get', name: 'cookies-get')]
    public function page(Request $request): Response
    {
        dump( $request->cookies->get('theme') );

        return $this->render('cookies/index.html.twig');
    }

    #[Route('/cookie/definir-theme/{theme}', name: 'definir-theme-dracula')]
    public function definirTheme($theme): Response
    {
        # Création d'une réponse de type redirection
        $response = $this->redirectToRoute('cookies-get');

        # Création cookie pour la réponse
        $cookie = Cookie::create('theme',$theme); # COOKIE DUREE DE VIE DE LA SESSION
        #$cookie = Cookie::create('theme',$theme, new \DateTime('+7 DAY')); # COOKIE AVEC DUREE DE VIE

        $response->headers->setCookie($cookie); # Ajout du cookie à la réponse

        # Renvoi de la réponse
        return $response;
    }

    #[Route('/cookie/supprimer', name: 'supprimer-cookie')]
    public function supprime(): Response
    {
        # Création réponse de type redirection
        $response = $this->redirectToRoute('cookies-get');

        # Suppression cookie dans la réponse
        $response->headers->clearCookie('theme');

        # Renvoi réponse -> navigateur
        return $response;
    }
}
