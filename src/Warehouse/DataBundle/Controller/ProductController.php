<?php

namespace Warehouse\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function postProductAction(Request $req)
    {
        $req_array = json_decode($req->get['product'], true); 
        $ok = $this->get('product_functions')->addNewProduct($req_array);
        if($ok)
        {
            $this->get('warehouse_functions')->generateNewWarehouseData();
            return new Response($status = 200);
        }
        else
        {
            return new Response($status = 409);
        }
        
        
        //refresh warehouse
    }
    
    
}