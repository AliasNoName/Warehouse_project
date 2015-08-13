<?php

namespace Warehouse\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cafe
 *
 * @ORM\Table(name="cafe")
 * @ORM\Entity
 */
class Cafe
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cafe_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     * @return Cafe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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
