<?php

namespace App\Controller;

use App\Service\Commande\CommandeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(CommandeService $commandeService): Response
    {
        return $this->render('admin/index.html.twig', [
            'chiffreAffaires' => $commandeService->getChiffreAffaires(),
            'nbCommandesEnAttente' => $commandeService->getNbCommandeEnAttente(),
            'nbCommandesLivrees' => $commandeService->getNbCommandeLivree(),
        ]);
    }
}
