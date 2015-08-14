<?php

namespace Warehouse\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;

class WarehouseController extends Controller
{
    /**
     * @return array
     * @View()
     */
    public function getWarehouseAction()
    {
        
        $warehouse = $this->get('warehouse_functions');
        if($warehouse->generateNewWarehouseData())
        {
            $info = $warehouse->getWarehouseInfo();
            return array('warehouse' => $info);
        }
        else
        {
            return "nista";
        }
        
    }
    
    //public function postProductsAction()
    
    
    
}