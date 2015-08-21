<?php

namespace Warehouse\DataBundle\DataFunctions;


use Warehouse\DataBundle\Entity\ProductList;
use Warehouse\DataBundle\Entity\ListNumerated;
use Warehouse\DataBundle\DataFunctions\WarehouseFunctions;

use Doctrine\ORM\EntityManager;


class ListFunctions
{
    protected $em;
    protected $warehouse;
    
    public function __construct(EntityManager $em, WarehouseFunctions $w)
    {
        $this->em           = $em;
        $this->warehouse    = $w;
    }
    
    //creates new product list
    //product list should be received using HTTP/POST - NOT IMPLEMENTED
    public function addNewProductsList($productsList, $cafe)
    {
        $qb = $this->em->createQueryBuilder();
        $list = new ListNumerated();
        
        $q = $qb->select('c')->from('Warehouse\DataBundle\Entity\Cafe', 'c')->where('c.id = ?1')->getQuery()->setParameter(1, $cafe['id']);
        $c = $q->execute();
        
        $list->setCafe($c[0]);
        
        $this->em->getConnection()->beginTransaction();
        try
        {
            $this->addToDatabase($list);
        
            $q = $qb->select('p')
                ->from('Warehouse\DataBundle\Entity\Product', 'p')
                ->where('p.id = ?1 ')
                ->getQuery();   
        
            foreach($productsList as $listEntry)
            {
                $q->setParameter(1,$listEntry['product']['id']);
                $product = $q->execute();

                $productList = new ProductList();
                $productList->setList($list)
                    ->setQuantity($listEntry['quantity'])
                    ->setProduct($product[0]);

                $this->addToDatabase($productList);

                $this->warehouse->updateWarehouseProductQuantityFromList($productList);
                
            }

            $message = $this->warehouse->checkSuplyNeeded();
        } 
        catch (Exception $e) {
            // Rollback the failed transaction attempt
            $em->getConnection()->rollback();
            throw $e;
        }
        
        return true;

        
        
    }
    
    public function getAllLists()
    {
        $q = $this->em->createQuery('SELECT l from Warehouse\DataBundle\Entity\ListNumerated l');
        return $q->getResult();
    }
    
    public function getDetailedList($id)
    {
        $q = $this->em->createQuery('
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