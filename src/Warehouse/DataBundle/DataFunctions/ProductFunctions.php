<?php

namespace Warehouse\DataBundle\DataFunctions;

use Warehouse\DataBundle\Entity\Product;
use Warehouse\DataBundle\Entity\ListNumerated;

use Doctrine\ORM\EntityManager;
//use Symfony\Component\Serializer\Serializer;

class ProductFunctions
{
    protected $em;
    protected $serializer;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        //$this->serializer = $ser;
    }
    
    //returns all products in JSON format
    public function getAllProducts()
    {  
        $query = $this->em->createQuery('SELECT p FROM Warehouse\DataBundle\Entity\Product p ');

        $products = $query->getResult();
       
        return $products;
    }
    
    //adds new product to offer
    //product should be received using HTTP/POST - NOT IMPLEMENTED
    public function addNewProduct($product)
    {    
        $new_product = $this->serializer->deserialize($product, 'Warehouse\DataBundle\Entity\Product', 'json');
        
        $this->addToDatabase($new_product);
                
        return $new_product->getName();
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