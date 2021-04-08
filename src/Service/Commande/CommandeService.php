<?php


namespace App\Service\Commande;


use App\Repository\CommandeRepository;
use App\Repository\LigneCommandeRepository;

class CommandeService
{
    protected $commandeRepository;
    protected $ligneCommandeRepository;

    public function __construct(CommandeRepository $commandeRepository, LigneCommandeRepository $ligneCommandeRepository)
    {

        $this->commandeRepository = $commandeRepository;
        $this->ligneCommandeRepository = $ligneCommandeRepository;

    }

    public function getNbCommandeEnAttente()
    {
        return count($this->commandeRepository->findBy(["statutCommande" => 1,]));

    }

    public function getNbCommandeLivree()
    {
        return count($this->commandeRepository->findBy(["statutCommande" => 4,]));

    }

    public function getChiffreAffaires()
    {
        $chiffreAffaires = 0;
        $commandeslivrees = $this->commandeRepository->findBy(["statutCommande" => 4,]);

        foreach ($commandeslivrees as $commande){
            $lignesCommande = $this->ligneCommandeRepository->findBy(["commandeId" => $commande->getId()]);
            foreach ($lignesCommande as $ligne){
                $article =  $ligne->getArticleId();
                $chiffreAffaires += $ligne->getQte() * $article->getPrixU();
            }
        }

        return floatval($chiffreAffaires);
    }
}

