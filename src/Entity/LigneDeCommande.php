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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    public function setArticleId(?int $articleId): self
    {
        $this->articleId = $articleId;

        return $this;
    }

    public function getCommandeId(): ?int
    {
        return $this->commandeId;
    }

    public function setCommandeId(?int $commandeId): self
    {
        $this->commandeId = $commandeId;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(?int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }


}
