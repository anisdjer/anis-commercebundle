<?php

namespace Anis\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LigneFacture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Anis\CommerceBundle\Entity\LigneFactureRepository")
 * @UniqueEntity(fields={})
 */
class LigneFacture
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
     * @var Produit
     *
     * @ORM\ManyToOne(targetEntity="Anis\CommerceBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false , unique=false)
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="unity_price", type="float")
     */
    private $unityPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;

    /**
     * @ORM\ManyToOne(targetEntity="Anis\CommerceBundle\Entity\Facture" , inversedBy="lines",cascade={"all"})
     * @ORM\JoinColumn(name="facture", referencedColumnName="id", nullable=false)
     */
    private $facture;


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
     * Set quantity
     *
     * @param integer $quantity
     * @return LigneFacture
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * Set product
     *
     * @param Produit $product
     * @return LigneFacture
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Produit
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set unityPrice
     *
     * @param float $unityPrice
     * @return LigneFacture
     */
    public function setUnityPrice($unityPrice)
    {
        $this->unityPrice = $unityPrice;
    
        return $this;
    }

    /**
     * Get unityPrice
     *
     * @return float 
     */
    public function getUnityPrice()
    {
        return $this->unityPrice;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return LigneFacture
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    
        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }
    /**
     * Set discount
     *
     * @param float $facture
     * @return LigneFacture
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return float
     */
    public function getFacture()
    {
        return $this->facture;
    }

    public function __toString()
    {
        return $this->getProduct()->__toString();
    }
}