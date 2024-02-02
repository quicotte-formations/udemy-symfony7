<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QueryController extends AbstractController
{
    #[Route('/query', name: 'app_query')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $query = $entityManager->createQuery("
        SELECT 	g.nom, COUNT(f) nb_films, MIN(f.annee) annee_min
        FROM	App:Genre g
                JOIN g.films f
        GROUP BY g
        HAVING  nb_films > 50
                AND annee_min BETWEEN 1960 AND 1980
        ");
        $res = $query->getResult();
        dump( $res );
    }
}
