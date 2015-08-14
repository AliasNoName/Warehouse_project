<?php

namespace Warehouse\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;

class ProductController extends Controller
{
    /**
     * @return array
     * @View()
     */
    public function getProductsAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('WarehouseDataBundle:Product')
            ->findAll();
        
        return array('products' => $products);
    }
    
}