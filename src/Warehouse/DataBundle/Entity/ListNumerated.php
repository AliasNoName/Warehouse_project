<?php

namespace Warehouse\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListNumerated
 *
 * @ORM\Table(name="list_numerated")
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
    public function setDeliveredOn($deliveredOn)
    {
        $this->deliveredOn = $deliveredOn;

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
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

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
}
