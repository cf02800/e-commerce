<?php

namespace App\Repository;

use App\Entity\StatutCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatutCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutCommande[]    findAll()
 * @method StatutCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutCommande::class);
    }

}