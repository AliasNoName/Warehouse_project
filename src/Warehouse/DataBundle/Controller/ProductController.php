<?php

namespace Warehouse\DataBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class ProductController extends FOSRestController
{
    public function getProductAction()
    {
        return $this->container->get('doctrine.entity_manager')->getRepository('Product')->find(1);
    }
    
}