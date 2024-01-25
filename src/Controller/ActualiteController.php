<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    private ActualiteRepository $actualiterepository;

    public function __construct(ActualiteRepository $actualiterepository)
    {
        $this->actualiterepository = $actualiterepository;
    }
    #[Route('/actualite/{id}', name: 'app_actualite')]
    public function index(int $id): Response
    {
        $actu = $this->actualiterepository->find($id);

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actu' => $actu
        ]);
    }
}
