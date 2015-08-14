<?php

namespace Warehouse\DataBundle\DataFunctions;


use AppBundle\Entity\Product;
use AppBundle\Entity\ListNumerated;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;


class ListFunctions
{
    protected $em;
    protected $serializer;
    protected $warehouse;
    
    public function __construct(EntityManager $em, Serializer $ser, DataWarehouse $dw)
    {
        $this->em           = $em;
        $this->serializer   = $ser;
        $this->warehouse    = $dw;
    }
    
    //creates new product list
    //product list should be received using HTTP/POST - NOT IMPLEMENTED
    public function addNewProductsList($productsList)
    {
        $new_list = new ListNumerated();
        
        $this->addToDatabase($new_list);
                
        $list_entry = $this->serializer->
            deserialize($productsList,
                        'ArrayCollection<AppBundle\Entity\ProductList>', 
                        'json');
        
        foreach($list_entry as $entry)
        {
            $entry->setProductList($new_list);
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