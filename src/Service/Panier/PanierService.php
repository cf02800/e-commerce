<?php


namespace App\Service\Panier;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticleRepository;

class PanierService
{
    protected $session;
    protected $articleRepository;

    public function __construct(SessionInterface $session, ArticleRepository $articleRepository){

        $this->session = $session;
        $this->articleRepository = $articleRepository;

    }

    public function add(int $id){

        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id){

        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }

    public function getFullPanier() : array{

        $panier = $this->session->get('panier', []);

        $panierWithArticle=[];

        foreach($panier as $id => $qte) {
            $panierWithArticle[] = [
                'article' => $this->articleRepository->find($id),
                'quantity' => $qte
            ];
        }

        return $panierWithArticle;
    }

    public function getTotal() : float 
    {
        $total = 0;
        $panier = $this->getFullPanier();

        foreach ($panier as $item){
            $total += $item['article']->getPrixU() * $item['quantity'];
        }

        return $total;
    }

}