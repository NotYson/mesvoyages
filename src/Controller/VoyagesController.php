<?php

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]);
    }
    #[Route('/voyages/tri/{champ}/{ordre}', name: 'voyages.sort')]
    public function sort(string $champ, string $ordre): Response

    {
        // On utilise la méthode perso du repository
        $visites = $this->repository->findAllOrderBy($champ, $ordre);

        return $this->render('pages/voyages.html.twig', [
            'visites' => $visites,
        ]);
    }
}
