<?php


namespace App\Repository;

use App\Entity\TypeArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeArticle[]    findAll()
 * @method TypeArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */


class TypeArticleRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeArticle::class);
    }

}