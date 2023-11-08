<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Entity\Adresse;
use App\Entity\Cabinet;
use App\Entity\Emploi;
use App\Entity\Employe;
use App\Entity\Expertise;
use App\Entity\Image;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Réseau H10 | Panel administrateur')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Actualités', 'fa fa-newspaper', Actualite::class),
            MenuItem::linkToCrud('Expertises', 'fa-solid fa-pen-fancy', Expertise::class),
            MenuItem::linkToCrud('Employés', 'fa-solid fa-users', Employe::class),
            MenuItem::linkToCrud('Cabinets', 'fa-solid fa-house', Cabinet::class),
            MenuItem::linkToCrud('Adresses', 'fa-solid fa-location-dot', Adresse::class),
            MenuItem::linkToCrud('Offres d\'emplois', 'fa-solid fa-clipboard', Emploi::class),
            MenuItem::linkToCrud('Galerie', 'fa fa-picture-o', Image::class),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class)
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        ];
    }
}
