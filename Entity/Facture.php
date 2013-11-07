<?php

namespace Anis\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Anis\CommerceBundle\Entity\FactureRepository")
 */
class Facture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facturation", type="date")
     */
    private $dateFacturation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_paiement", type="date")
     */
    private $datePaiement;

    /**
     * @var string
     *
     * @ORM\Column(name="method_paiement", type="string", length=255)
     */
    private $methodPaiement;

    /**
     * @var float
     *
     * @ORM\Column(name="somme", type="float")
     */
    private $total;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paid", type="boolean", nullable=true)
     */
    private $paid;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Anis\CommerceBundle\Entity\LigneFacture", orphanRemoval=true, mappedBy="facture")
     */
    private $lines;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="Anis\CommerceBundle\Entity\Client"  )
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $client;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lines = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateFacturation
     *
     * @param \DateTime $dateFacturation
     * @return Facture
     */
    public function setDateFacturation($dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;
    
        return $this;
    }

    /**
     * Get dateFacturation
     *
     * @return \DateTime 
     */
    public function getDateFacturation()
    {
        return $this->dateFacturation;
    }

    /**
     * Set datePaiement
     *
     * @param \DateTime $datePaiement
     * @return Facture
     */
    public function setDatePaiement($datePaiement)
    {
        $this->datePaiement = $datePaiement;
    
        return $this;
    }

    /**
     * Get datePaiement
     *
     * @return \DateTime 
     */
    public function getDatePaiement()
    {
        return $this->datePaiement;
    }

    /**
     * Set methodPaiement
     *
     * @param string $methodPaiement
     * @return Facture
     */
    public function setMethodPaiement($methodPaiement)
    {
        $this->methodPaiement = $methodPaiement;
    
        return $this;
    }

    /**
     * Get methodPaiement
     *
     * @return string 
     */
    public function getMethodPaiement()
    {
        return $this->methodPaiement;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Facture
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        /*$this->total = 0;
        foreach($this->getLines() as $line)
        {
            $this->total += $line->getProduct()->getPrice();
        }*/
        return $this->total;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     * @return Facture
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    
        return $this;
    }

    /**
     * Get paid
     *
     * @return boolean
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Add lines
     *
     * @param \Anis\CommerceBundle\Entity\LigneFacture $lines
     * @return Facture
     */
    public function addLine(\Anis\CommerceBundle\Entity\LigneFacture $lines)
    {
        $this->lines[] = $lines;
    
        return $this;
    }

    /**
     * Remove lines
     *
     * @param \Anis\CommerceBundle\Entity\LigneFacture $lines
     */
    public function removeLine(\Anis\CommerceBundle\Entity\LigneFacture $lines)
    {
        $this->lines->removeElement($lines);
    }

    /**
     * Get lines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLines()
    {
        return $this->lines;
    }

    public function emptyLines()
    {
        $this->lines = new \Doctrine\Common\Collections\ArrayCollection();


        return $this;
    }

    /**
     * Set client
     *
     * @param \Anis\CommerceBundle\Entity\Client $client
     * @return Facture
     */
    public function setClient(\Anis\CommerceBundle\Entity\Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \Anis\CommerceBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    public function toArray()
    {
        $attributes = array();
        if($this->id!= NULL)
            $attributes["id"] = $this->id;

        $attributes["dateFacturation"] = $this->dateFacturation ? $this->dateFacturation->format('d-m-Y') : "--" ;

        $attributes["datePaiement"] = $this->datePaiement ? $this->datePaiement->format('d-m-Y') : "--" ;

        $attributes["methodPaiement"] = $this->methodPaiement ? $this->methodPaiement : '--';

        $attributes["total"] = $this->total > 0? $this->getTotal() : 0;
        $attributes["paid"] = $this->paid ? "Oui" : "Non";
        //die(var_dump($attributes));
        return $attributes;
    }


    public function __toString()
    {
        return $this->getClient()->__toString();
    }
}