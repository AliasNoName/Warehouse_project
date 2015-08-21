<?php

namespace Warehouse\DataBundle\DataFunctions;


use Warehouse\DataBundle\Entity\Cafe;

use Doctrine\ORM\EntityManager;

class CafeFunctions
{
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em           = $em;
    }
    
    public function getCafeList()
    {
        return $this->em->createQuery('SELECT c FROM Warehouse\DataBundle\Entity\Cafe c')->getResult();
    }
}
