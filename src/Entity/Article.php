<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="IDX_23A0E666F9750B9", columns={"type_article_id"})})
 * @ORM\Entity
 */
class Article
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_u", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixU;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \TypeArticle
     *
     * @ORM\ManyToOne(targetEntity="TypeArticle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_article_id", referencedColumnName="id")
     * })
     */
    private $typeArticle;


}
