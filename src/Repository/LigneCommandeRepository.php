<?php


namespace App\Repository;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\LigneDeCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigneDeCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneDeCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneDeCommande[]    findAll()
 * @method LigneDeCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */


class LigneCommandeRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneDeCommande::class);
    }

}