<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\ModePaiement;
use App\Form\AdresseType;
use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @var PanierService
     */
    private $PanierService;

    public function __construct(PanierService $PanierService){
        $this->PanierService = $PanierService;
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function index(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $client = $this->getUser();

        $p = $this->PanierService;
        $total = $p->getTotal();

        $adresses = $this->getDoctrine()
            ->getRepository(Adresse::class)
            ->findByClient($client->getId());

        return $this->render('commande/index.html.twig' , [
            'controller_name' => 'CommandeController',
            'panier' => $p->getFullPanier(),
            'adresses' => $adresses,
            'prixTot' => $total,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/adresse", name="adresse_create")
     */
    public function newAdresse(Request $request) : Response {

        $entityManager = $this->getDoctrine()->getManager();
        $adr = new Adresse();

        $formAdresse = $this->createForm(AdresseType::class,$adr);

        $formAdresse->handleRequest($request);

        if($formAdresse->isSubmitted() && $formAdresse->isValid()){
            $adr->setClient($this->getUser());
            $entityManager->persist($adr);
            $entityManager->flush();

            return $this->redirectToRoute('commande');
        }

        return $this->render('adresse/form.html.twig',[
            'form' => $formAdresse->createView(),
        ]);
    }
}