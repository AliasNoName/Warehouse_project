<?php

namespace Warehouse\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WarehouseProduct
 *
 * @ORM\Table(name="warehouse_product", indexes={@ORM\Index(name="IDX_F4AD11D84584665A", columns={"product_id"})})
 * @ORM\Entity
 */
class WarehouseProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_quantity", type="integer", nullable=true)
     */
    private $minQuantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="warehouse_entry", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="warehouse_product_warehouse_entry_seq", allocationSize=1, initialValue=1)
     */
    private $warehouseEntry;

    /**
     * @var \Warehouse\DataBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Warehouse\DataBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;



    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return WarehouseProduct
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
     * Set minQuantity
     *
     * @param integer $minQuantity
     * @return WarehouseProduct
     */
    public function setMinQuantity($minQuantity)
    {
        $this->minQuantity = $minQuantity;

        return $this;
    }

    /**
     * Get minQuantity
     *
     * @return integer 
     */
    public function getMinQuantity()
    {
        return $this->minQuantity;
    }

    /**
     * Get warehouseEntry
     *
     * @return integer 
     */
    public function getWarehouseEntry()
    {
        return $this->warehouseEntry;
    }

    /**
     * Set product
     *
     * @param \Warehouse\DataBundle\Entity\Product $product
     * @return WarehouseProduct
     */
    public function setProduct(\Warehouse\DataBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Warehouse\DataBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
