<?php

namespace Warehouse\DataBundle\DataFunctions;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;

use AppBundle\Data\DataProduct;

use AppBundle\Entity\Product;
use AppBundle\Entity\Warehouse;

class WarehouseFunctions
{
    protected $em;
    protected $serializer;
    
    
    public function __construct(EntityManager $em, Serializer $ser)
    {
        $this->em = $em;
        $this->serializer = $ser;
    }
    
    //after adding new items to offer, they need to be registered in warehouse,
    //AFTER set min_quantity and quantity in DBMS
    public function generateNewWarehouseData()
    {
        $query = $this->em->createQuery('
        SELECT p FROM AppBundle\Entity\Product p 
        LEFT JOIN AppBundle\Entity\Warehouse w WITH
        p = w.product
        WHERE w.product IS NULL
        ');
        
        $products = $query->getResult();
        
        foreach($products as $product)
        {
            $warehouse_entry = new Warehouse();
            
            $warehouse_entry->setProduct($product);
            $warehouse_entry->setQuantity(0);
            $warehouse_entry->setMinQuantity(0);
            
            
            $this->addToDatabase($warehouse_entry);
            
            unset($warehouse_entry);
            
        }
        
        return 1;
    }
    
    //updates new quantities to warehouse
    //AFTER call checkSuplyNeeded()
    public function updateWarehouseProductQuantity($product)
    {    
        $qb = $this->em->createQueryBuilder();
        
        $q = $qb->update('Warehouse', 'w')
            ->set('u.quantity', 'u.quantity - ?1')
            ->where('u.product = ?2')
            ->setParameter(1, $product->getProductListProductQuantity())
            ->setParameter(2, $product->getProductListProduct())
            ->getQuery();
        
        $p = $q->execute();

        if( $p != 1)
        {
            throw new Exception('imamo problema sa update query nad bazom podataka');
        } 
    }
    
    //checks if quantities are below minimum
    //collects all info and sends email for suply
    public function checkSuplyNeeded()
    {
        $q = $this->em->createQuery('
        SELECT w.porduct_id FROM AppBundle\Entity\Warehouse w
        WHERE (w.quantity-w.min_quantity) < 0
        ');
        
        $notify_list = $q->getResult();
        
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