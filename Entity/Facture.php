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
     * @ORM\Column(name="paid", type="boolean")
     */
    private $paid;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Anis\CommerceBundle\Entity\LigneFacture", orphanRemoval=true, mappedBy="facture")
     */
    private $lines;


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
     * Set somme
     *
     * @param float $somme
     * @return Facture
     */
    public function setTotal($somme)
    {
        $this->total = $somme;
    
        return $this;
    }

    /**
     * Get somme
     *
     * @return float 
     */
    public function getTotal()
    {
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
     * Add line
     *
     * @param \Anis\CommerceBundle\Entity\LigneFacture $line
     * @return Facture
     */
    public function addUnityInvoice(\Anis\CommerceBundle\Entity\LigneFacture $line)
    {
        $this->lines[] = $line;
    
        return $this;
    }

    /**
     * Remove line
     *
     * @param \Anis\CommerceBundle\Entity\LigneFacture $line
     */
    public function removeLine(\Anis\CommerceBundle\Entity\LigneFacture $line)
    {
        $this->unityInvoices->removeElement($line);
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
}