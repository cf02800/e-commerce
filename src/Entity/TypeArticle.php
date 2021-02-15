<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeArticle
 *
 * @ORM\Table(name="type_article", indexes={@ORM\Index(name="IDX_2A1B6193BCF5E72D", columns={"categorie_id"})})
 * @ORM\Entity
 */
class TypeArticle
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
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * })
     */
    private $categorie;


}