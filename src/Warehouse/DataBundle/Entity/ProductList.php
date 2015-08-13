<?php

namespace Warehouse\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductList
 *
 * @ORM\Table(name="product_list", indexes={@ORM\Index(name="IDX_C920DAB94584665A", columns={"product_id"}), @ORM\Index(name="IDX_C920DAB93DAE168B", columns={"list_id"})})
 * @ORM\Entity
 */
class ProductList
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
     * @ORM\Column(name="entry_num", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_list_entry_num_seq", allocationSize=1, initialValue=1)
     */
    private $entryNum;

    /**
     * @var \Warehouse\DataBundle\Entity\ListNumerated
     *
     * @ORM\ManyToOne(targetEntity="Warehouse\DataBundle\Entity\ListNumerated")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="list_id", referencedColumnName="id")
     * })
     */
    private $list;

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
     * @return ProductList
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
     * Get entryNum
     *
     * @return integer 
     */
    public function getEntryNum()
    {
        return $this->entryNum;
    }

    /**
     * Set list
     *
     * @param \Warehouse\DataBundle\Entity\ListNumerated $list
     * @return ProductList
     */
    public function setList(\Warehouse\DataBundle\Entity\ListNumerated $list = null)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return \Warehouse\DataBundle\Entity\ListNumerated 
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set product
     *
     * @param \Warehouse\DataBundle\Entity\Product $product
     * @return ProductList
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
