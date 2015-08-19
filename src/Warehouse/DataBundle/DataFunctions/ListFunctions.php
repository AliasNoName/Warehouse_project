<?php

namespace Warehouse\DataBundle\DataFunctions;


use Warehouse\DataBundle\Entity\ProductList;
use Warehouse\DataBundle\Entity\ListNumerated;

use Doctrine\ORM\EntityManager;


class ListFunctions
{
    protected $em;
    protected $warehouse;
    
    public function __construct(EntityManager $em)
    {
        $this->em           = $em;
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
    
    public function getAllLists()
    {
        $q = $this->em->createQuery('SELECT l from Warehouse\DataBundle\Entity\ListNumerated l');
        return $q->getResult();
    }
    
    public function getDetailedList($id)
    {
        $q = $htis->em->createQuery('
        SELECT l from Warehouse\DataBundle\Entity\ProductList l
        WHERE l.entryNum = ?1')->setParameter(1,$id);
        return $q->getResult();
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