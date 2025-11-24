<?php

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;   // <- IMPORTANT pour $request
use Symfony\Component\Routing\Annotation\Route;

class VoyagesController extends AbstractController
{
    /**
     * @var VisiteRepository
     */
    private $repository;

    public function __construct(VisiteRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/voyages', name: 'voyages')]
    public function index(): Response
    {
        // affichage par défaut : trié par date de création, les plus récentes d'abord
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');

        return $this->render('pages/voyages.html.twig', [
            'visites' => $visites,
        ]);
    }

    #[Route('/voyages/tri/{champ}/{ordre}', name: 'voyages.sort')]
    public function sort(string $champ, string $ordre): Response
    {
        // tri générique sur le champ + ordre passés dans l'URL
        $visites = $this->repository->findAllOrderBy($champ, $ordre);

        return $this->render('pages/voyages.html.twig', [
            'visites' => $visites,
        ]);
    }

    #[Route('/voyages/recherche/{champ}', name: 'voyages.findallequal')]
    public function findAllEqual(string $champ, Request $request): Response
    {
        // récupère la valeur saisie dans le formulaire (name="recherche")
        $valeur = $request->get('recherche');

        // utilise ta méthode perso du repository
        $visites = $this->repository->findByEqualValue($champ, $valeur);

        return $this->render('pages/voyages.html.twig', [
            'visites' => $visites,
        ]);
    }
}
