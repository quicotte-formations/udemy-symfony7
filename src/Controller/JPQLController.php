<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JPQLController extends AbstractController
{
    /**
     * Le nombre de films par genre, pour les films interprétés par Eddie Murphy
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/req12')]
    public function req12( EntityManagerInterface $entityManager ): Response
    {
        $dql="  SELECT g.nom nom_genre, COUNT(f) total
                FROM  App:Genre g 
                      JOIN g.films f
                      JOIN f.acteurs a
                WHERE a.libelle='Eddie Murphy'
                GROUP BY g";
        $query = $entityManager->createQuery( $dql );

        dump( $query->getResult() );
    }

    /**
     * Le nombre de films pour les réalisateurs ayant réalisé plus de 20 films, triés par ordre décroissant
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/req11')]
    public function req11( EntityManagerInterface $entityManager ): Response
    {
        $dql="SELECT    c.libelle real, COUNT(f) total
              FROM      App:Casting c 
                        JOIN c.filmsRealises f
              GROUP BY c
              HAVING total>20
              ORDER BY total DESC";
        $query = $entityManager->createQuery( $dql );

        dump( $query->getResult() );
    }

    /**
     * Le nombre de films groupé par pays ( donc champs: nom_pays et total )
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/req10')]
    public function req10( EntityManagerInterface $entityManager ): Response
    {
        $dql="  SELECT  p.nom nom_pays, COUNT(f) total
                FROM    App:Pays p
                        JOIN p.films f
                GROUP BY p";
        $query = $entityManager->createQuery( $dql );

        dump( $query->getResult() );
    }

    #[Route('/req9')]
    public function req9( EntityManagerInterface $entityManager ): Response
    {
        $dql="SELECT  MIN(f.annee) annee_min, MAX(f.annee) annee_max
              FROM    App:Film f
                      JOIN f.genres g 
              WHERE   g.nom='Science-Fiction'";
        $query = $entityManager->createQuery($dql);
        dump( $query->getSingleResult() );
    }

    #[Route('/req8')]
    public function req8( EntityManagerInterface $entityManager ): Response
    {
        $dql="SELECT COUNT(f) total
              FROM App:Film f 
                   JOIN f.acteurs a 
              WHERE a.libelle='Eddie Murphy'";
        $query = $entityManager->createQuery($dql);
        dump( $query->getSingleScalarResult() );
    }

    #[Route('/req7')]
    public function req7( EntityManagerInterface $entityManager ): Response
    {
        $dql = "
            SELECT  f 
            FROM    App:Film f
                    JOIN f.genres g
            WHERE   g.nom='Horreur-Epouvante'
                    AND f in (
                        SELECT  f2
                        FROM    App:Film f2
                                JOIN f.genres g2
                        WHERE   g2.nom='Comédie' )                    
            ";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }

    #[Route('/req6')]
    public function req6( EntityManagerInterface $entityManager ): Response
    {
        $dql = "
            SELECT  c    
            FROM    App:Casting c
                    JOIN c.filmsRealises fr
                    JOIN fr.acteurs act 
            WHERE act.libelle='Bruce Lee'";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }

    #[Route('/req5')]
    public function req5( EntityManagerInterface $entityManager ): Response
    {
        $dql = "    
    SELECT  f
    FROM    App:Film f
            JOIN f.realisateurs r
            JOIN f.genres g
    WHERE   r.libelle='Woody Allen'
            AND g.nom='Comédie'
";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }

    #[Route('/req4')]
    public function req4( EntityManagerInterface $entityManager ): Response
    {
        $dql = "    SELECT  a
                    FROM    App:Casting a
                            JOIN a.filmsInterpretes f
                    WHERE   f.titre='The Thing'
                            AND f.annee=1982
";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }

    #[Route('/req3')]
    public function req3( EntityManagerInterface $entityManager ): Response
    {
        $dql = "    SELECT  f
                    FROM    App:Film f
                            JOIN f.genres g
                    WHERE   g.nom='Horreur-Epouvante'
";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }

    #[Route('/req2')]
    public function req2( EntityManagerInterface $entityManager ): Response
    {
        $dql = "SELECT  g    
                FROM    App:Genre g
                ORDER BY g.nom ASC
";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }

    #[Route('/req1')]
    public function req1( EntityManagerInterface $entityManager ): Response
    {
        $dql = "    SELECT p
                    FROM App:Pays p
";
        $query = $entityManager->createQuery( $dql );
        $paysTrouves = $query->getResult();
        dump( $paysTrouves );
    }
}
