<?php

namespace Anis\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Anis\CommerceBundle\Entity\ClientRepository")
 */
class Client
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
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="emailaddress", type="string", length=255)
     */
    private $emailAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     * @Assert\Range(min=0, minMessage="Age must be positive > 0",
     *               invalidMessage = "Discount is not a valid number")
     */
    private $age;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registrationDate", type="date", nullable=true)
     */
    private $registrationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastVisit", type="date", nullable=true)
     */
    private $lastVisit;



    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=2)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=8)
     */
    private $cin;
    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=8, nullable=true)
     */
    private $tel;






    public function __construct(){
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
     * Set firstname
     *
     * @param string $firstname
     * @return Client
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Client
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set emailaddress
     *
     * @param string $emailaddress
     * @return Client
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailAddress = $emailaddress;
    
        return $this;
    }

    /**
     * Get emailaddress
     *
     * @return string 
     */
    public function getEmailaddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Client
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Client
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     * @return Client
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    
        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime 
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set lastVisit
     *
     * @param \DateTime $lastVisit
     * @return Client
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;
    
        return $this;
    }

    /**
     * Get lastVisit
     *
     * @return \DateTime 
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }


    /**
     * Set gender
     *
     * @param string $gender
     * @return Client
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Client
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }
    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    public function toArray()
    {
        $attributes = array();
        if($this->id!= NULL)
            $attributes["id"] = $this->id;
        if($this->firstname!= NULL)
            $attributes["firstname"] = $this->firstname;
        if($this->lastname!= NULL)
            $attributes["lastname"] = $this->lastname;
        if($this->emailAddress!= NULL)
            $attributes["emailAddress"] = $this->emailAddress;
        if($this->age!= NULL)
            $attributes["age"] = $this->age;
        if($this->cin!= NULL)
            $attributes["cin"] = $this->cin;
        if($this->tel!= NULL)
            $attributes["tel"] = $this->tel;
        return $attributes;
    }


    public function __toString()
    {
        return $this->getFirstname()." ".$this->getLastname();//json_encode($this->toArray());
    }
}