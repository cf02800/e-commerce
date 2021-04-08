<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="LigneDeCommande", mappedBy="commandeId")
     */
    private $lignes;


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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|LigneDeCommande[]
     */
    public function getLignesDeCommande(): Collection
    {
        return $this->lignes;
    }

    public function addLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        $this->lignes[] = $ligneDeCommande;
        $ligneDeCommande->setCommandeId($this);
        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if ($this->lignes->contains($ligneDeCommande)) {
            $this->lignes->removeElement($ligneDeCommande);
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getCommandeId() === $this) {
                $ligneDeCommande->setCommandeId(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getModePaiement(): ?ModePaiement
    {
        return $this->modePaiement;
    }

    public function setModePaiement(?ModePaiement $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatutCommande(): ?StatutCommande
    {
        return $this->statutCommande;
    }

    public function setStatutCommande(?StatutCommande $statutCommande): self
    {
        $this->statutCommande = $statutCommande;

        return $this;
    }


}
