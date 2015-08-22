<?php

namespace Warehouse\DataBundle\DataFunctions;

use Doctrine\ORM\EntityManager;

use Warehouse\DataBundle\DataFunctions\ProductFunctions;

use Warehouse\DataBundle\Entity\Product;
use Warehouse\DataBundle\Entity\WarehouseProduct;

class WarehouseFunctions
{
    protected $em;
    
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    //after adding new items to offer, they need to be registered in warehouse,
    //AFTER set min_quantity and quantity in DBMS
    public function generateNewWarehouseData()
    {
        $query = $this->em->createQuery('
        SELECT p FROM Warehouse\DataBundle\Entity\Product p 
        LEFT JOIN Warehouse\DataBundle\Entity\WarehouseProduct w WITH
        p = w.product
        WHERE w.product IS NULL
        ');
        
        $products = $query->getResult();
        
        foreach($products as $product)
        {
            $warehouse_entry = new WarehouseProduct();
            
            $warehouse_entry->setProduct($product);
            $warehouse_entry->setQuantity(0);
            $warehouse_entry->setMinQuantity(0);
            
            
            $this->addToDatabase($warehouse_entry);
            
            unset($warehouse_entry);
            
        }
        
        return 1;
    }
    
    public function getWarehouseInfo()
    {
        $query = $this->em->createQuery('SELECT w FROM Warehouse\DataBundle\Entity\WarehouseProduct w');
        
        return $query->getResult();
    }
    
    public function getWarehouseEntryInfo($id)
    {
        $query = $this->em->createQuery('
        SELECT w FROM Warehouse\DataBundle\Entity\WarehouseProduct w
        WHERE w.warehouseEntry = :foo');
        $query->setParameter('foo',$id);
        
        return $query->getResult();
    }
    
    //updates new quantities to warehouse
    //AFTER call checkSuplyNeeded()
    public function updateNewWarehouseProductQuantity($list_element)
    {    
        $qb = $this->em->createQueryBuilder();
        
        $q = $qb->update('Warehouse\DataBundle\Entity\WarehouseProduct', 'u')
            ->set('u.quantity',  '?1')
            ->set('u.minQuantity', '?2')
            ->where('u.warehouseEntry = ?3')
            ->getQuery()
            ->setParameter(1, $list_element->getQuantity())
            ->setParameter(2, $list_element->getMinQuantity())
            ->setParameter(3, $list_element->getWarehouseEntry());
            
        
        $p = $q->execute();
        if($p)
            return true;
        else
            return false;
    }
    
    public function updateWarehouseProductQuantityFromList($list_entry)
    {
        $qb = $this->em->createQueryBuilder();
        $quant = $list_entry->getQuantity();
        $q = $qb->update('Warehouse\DataBundle\Entity\WarehouseProduct', 'u')
            ->set('u.quantity',  'u.quantity - ?1')
            ->where('u.product = ?2')
            ->getQuery()
            ->setParameter(1, $quant)
            ->setParameter(2, $list_entry->getProduct());
        
        $n = $q->execute();
    }
    
    //checks if quantities are below minimum
    //collects all info and sends email for suply
    public function checkSuplyNeeded()
    {
        $qb = $this->em->createQueryBuilder();
        
        $q = $qb->select('wp')
            ->from('Warehouse\DataBundle\Entity\WarehouseProduct', 'wp')
            ->where('wp.quantity < wp.minQuantity')
            ->getQuery();
        
        $notify_list = $q->execute();
        
        return $notify_list;
;
    }
    
    
    
    
    private function addToDatabase($item)
    {
        try
        {
            $this->em->persist($item);
            $this->em->flush();
        }
        catch(Exception $e)
        {
            echo 'Something wrong with database' . $e;
        }
    }
}