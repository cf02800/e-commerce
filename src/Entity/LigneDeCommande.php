<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneDeCommande
 *
 * @ORM\Table(name="ligne_de_commande", indexes={@ORM\Index(name="article_id", columns={"article_id"}), @ORM\Index(name="commande_id", columns={"commande_id"})})
 * @ORM\Entity
 */
class LigneDeCommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="article_id", type="integer", nullable=true)
     */
    private $articleId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="commande_id", type="integer", nullable=true)
     */
    private $commandeId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="qte", type="integer", nullable=true)
     */
    private $qte;


}
