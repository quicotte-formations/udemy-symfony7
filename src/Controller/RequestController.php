<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{
    #[Route('/request', name: 'app_request')]
    public function index(Request $request): Response
    {
        $request->cookies->get('couleurPreferee');  # Valeur d'un cookie
        $request->get('cle');                       # Paramètre d'URL ( http://localhost:8080?cle=abc&cle2=xyz -> abc
        $request->getQueryString();                     # Query string : cle=abc&cle2=xyz
        $request->getPathInfo();                        # /URL relative -> /request
        $request->getClientIp();                        # IP du navigateur
        $request->getHost();                            # IP du serveur -> 127.0.0.1
        $request->getHttpHost();                        # IP et port serveur -> 127.0.0.1:8000


        return $this->render('request/index.html.twig', [
            'controller_name' => 'RequestController',
        ]);
    }
}
