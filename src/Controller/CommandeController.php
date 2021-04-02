<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\LigneDeCommande;
use App\Entity\ModePaiement;
use App\Entity\StatutCommande;
use App\Form\AdresseType;
use App\Form\SelectAdresseType;
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

    public function __construct(PanierService $PanierService)
    {
        $this->PanierService = $PanierService;
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function index(): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $client = $this->getUser();

        $p = $this->PanierService;
        $total = $p->getTotal();

        $adresses = $this->getDoctrine()
            ->getRepository(Adresse::class)
            ->findByClient($client->getId());

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'panier' => $p->getFullPanier(),
            'adresses' => $adresses,
            'prixTot' => $total,
        ]);
    }

    /**
     * @Route("/commande/new", name="commande_new")
     */

    public function newCommande(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $client = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $adresse = $request->query->get('adresse');
        $ad = $this->getDoctrine()
            ->getRepository(Adresse::class)
            ->find($adresse);
        $panier = $this->PanierService->getFullPanier();

        $LignesDeCommande = [];

        foreach($panier as $lignepanier){
            $ligne = new LigneDeCommande();
            $ligne->setQte($lignepanier['quantity']);
            $ligne->setArticleId($lignepanier['article']->getId());
            $em->persist($ligne);

            $LignesDeCommande[] = $ligne;
        }
        $modePaiement = $this->getDoctrine()
            ->getRepository(ModePaiement::class)
            ->findOneBy(['id' => "1"]);

        $statut = $this->getDoctrine()
            ->getRepository(StatutCommande::class)
            ->findOneBy(['code' => 1]);

        $commande = new Commande();
        $commande->setDate(new \dateTime('now'));
        $commande->setClient($client);
        $commande->setAdresse($ad);
        $commande->setModePaiement($modePaiement);
        $commande->setStatutCommande($statut);

        foreach($LignesDeCommande as $ligne){
            $commande->addLigneDeCommande($ligne);
        }

        $em->persist($commande);
        $em->flush();

        $this->PanierService->clear();

        return $this->redirectToRoute('accueil');



    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/adresse", name="adresse_create")
     */
    public function newAdresse(Request $request): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $adr = new Adresse();

        $formAdresse = $this->createForm(AdresseType::class, $adr);

        $formAdresse->handleRequest($request);

        if ($formAdresse->isSubmitted() && $formAdresse->isValid()) {
            $adr->setClient($this->getUser());
            $entityManager->persist($adr);
            $entityManager->flush();

            return $this->redirectToRoute('commande');
        }

        return $this->render('adresse/form.html.twig', [
            'form' => $formAdresse->createView(),
        ]);
    }
}
