<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticleRepository;
use App\Service\Panier\PanierService;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $service)
    {
        $panier = $service->getFullPanier();

        $total = $service->getTotal();
        
        return $this->render('panier/index.html.twig', [
            'items' => $panier,
            'total' => $total,
        ]);
    }

    /**
     * @Route("panier/add/{id}", name="panier_add")
     */

    public function add(int $id, PanierService $service) {

        $service->add($id);
        
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("panier/delete/{id}", name="panier_delete")
     */

     public function delete(int $id, PanierService $service) {
         
        $service -> remove($id);

        return $this->redirectToRoute('panier');
     }
}
