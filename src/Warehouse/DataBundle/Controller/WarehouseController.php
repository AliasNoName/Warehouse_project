<?php

namespace Warehouse\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;

class WarehouseController extends Controller 
{
    //dohvati stanje skladista
    /**
     * @return array
     * @View()
     */
    public function getWarehouseAction()
    {
        $warehouse = $this->get('warehouse_functions');
        $info = $warehouse->getWarehouseInfo();
        return array('warehouse' => $info); 
    }
    
    //dohvaća poseban entry skladista
     /**
     * @return array
     * @var integer $id warehouseEntry of entity
     * @View()
     */
    public function getWarehouseItemAction($id)
    {
        $warehouse = $this->get('warehouse_functions');
        $info = $warehouse->getWarehouseEntryInfo($id);
        return array('warehouse' => $info);
    }
    
    //upisi nove vrijednosti u bazu podataka za skladište
    /**
     * Put action
     * @var Request $request
     * @var integer $id Id of the entity
     * @return View|array
     */
    public function putWarehouseItemAction(Request $req, $id)
    {
        $warehouse = $this->get('warehouse_functions');
        $entry = $warehouse->getWarehouseEntryInfo($id);
        //treba dohvatit ono sta nam je poslao angular
        //pretvorit to u warehouse_entry
        $entry = $ser->deserialize($req->get('key'),'Warehouse\DataBundle\Entity\WarehouseProduct','json');
        
        //poslat f-ji wpdateWarehouseProductQuantity
        $warehouse->updateWarehouseProductQuantity($entry);
    }
    
    //public function postProductsAction()
    
    
    
}