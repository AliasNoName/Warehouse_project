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
        $products = $this->get('product_functions')->getAllProducts();
        
        return array('products' => $products);
    }
    
    //public function postProductsAction()
    
    
    
}