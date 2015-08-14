<?php

namespace Warehouse\DataBundle\DataFunctions;


use Warehouse\DataBundle\Entity\ProductList;
use Warehouse\DataBundle\Entity\ListNumerated;

use Doctrine\ORM\EntityManager;
use Warehouse\DataBundle\DataFunctions\WarehouseFunctions;


class ListFunctions
{
    protected $em;
    protected $warehouse;
    
    public function __construct(EntityManager $em, WarehouseFunctions $dw)
    {
        $this->em           = $em;
        $this->warehouse    = $dw;
    }
    
    //creates new product list
    //product list should be received using HTTP/POST - NOT IMPLEMENTED
    public function addNewProductsList($productsList)
    {
        $new_list = new ListNumerated();
        
        $this->addToDatabase($new_list);
        
        foreach($productsList as $e)
        {
            $new_entry = new ProductList();
            $new_entry->setQuantity($e->quantity)->setList($new_list)->setProduct($e->product);
            
            $this->addToDatabase($entry);
            $this->dw->updateWarehouseProductQuantity($entry);
        }
        
        return $this->dw->checkSuplyNeeded();
        
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