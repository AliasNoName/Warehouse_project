<?php

namespace Warehouse\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListNumerated
 *
 * @ORM\Table(name="list_numerated", indexes={@ORM\Index(name="IDX_68A9B72D4FBD7F10", columns={"cafe"})})
 * @ORM\Entity
 */
class ListNumerated
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="delivered", type="boolean", nullable=false)
     */
    private $delivered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivered_on", type="datetime", nullable=true)
     */
    private $deliveredOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="list_numerated_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Warehouse\DataBundle\Entity\Cafe
     *
     * @ORM\ManyToOne(targetEntity="Warehouse\DataBundle\Entity\Cafe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cafe", referencedColumnName="id")
     * })
     */
    private $cafe;
    
    public function __construct()
    {
        $this->setDelivered(false);
        $this->setCreatedOn();
    }



    /**
     * Set delivered
     *
     * @param boolean $delivered
     * @return ListNumerated
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;

        return $this;
    }

    /**
     * Get delivered
     *
     * @return boolean 
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Set deliveredOn
     *
     * @param \DateTime $deliveredOn
     * @return ListNumerated
     */
    public function setDeliveredOn()
    {
        $this->deliveredOn = new \DateTime("now");

        return $this;
    }

    /**
     * Get deliveredOn
     *
     * @return \DateTime 
     */
    public function getDeliveredOn()
    {
        return $this->deliveredOn;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ListNumerated
     */
    public function setCreatedOn()
    {
        $this->createdOn = new \DateTime("now");

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
     * Set cafe
     *
     * @param \Warehouse\DataBundle\Entity\Cafe $cafe
     * @return ListNumerated
     */
    public function setCafe(\Warehouse\DataBundle\Entity\Cafe $cafe = null)
    {
        $this->cafe = $cafe;

        return $this;
    }

    /**
     * Get cafe
     *
     * @return \Warehouse\DataBundle\Entity\Cafe 
     */
    public function getCafe()
    {
        return $this->cafe;
    }
}
