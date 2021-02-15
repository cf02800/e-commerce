<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="IDX_6EEAA67D19EB6921", columns={"client_id"}), @ORM\Index(name="IDX_6EEAA67D438F5B63", columns={"mode_paiement_id"}), @ORM\Index(name="IDX_6EEAA67D4DE7DC5C", columns={"adresse_id"}), @ORM\Index(name="IDX_6EEAA67DFB435DFD", columns={"statut_commande_id"})})
 * @ORM\Entity
 */
class Commande
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="frais_de_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $fraisDePort;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;

    /**
     * @var \ModePaiement
     *
     * @ORM\ManyToOne(targetEntity="ModePaiement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mode_paiement_id", referencedColumnName="id")
     * })
     */
    private $modePaiement;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adresse_id", referencedColumnName="id")
     * })
     */
    private $adresse;

    /**
     * @var \StatutCommande
     *
     * @ORM\ManyToOne(targetEntity="StatutCommande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="statut_commande_id", referencedColumnName="id")
     * })
     */
    private $statutCommande;


}
