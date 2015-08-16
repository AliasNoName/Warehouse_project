<?php

namespace Warehouse\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Warehouse\DataBundle\Entity\WarehouseProduct;

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
        
        
        $req_array = json_decode($req->getContent(), true); 
        $entry = json_decode($req_array['entry'], true);
        
        $warehouse_entry = $warehouse->getWarehouseEntryInfo($entry['warehouse_entry'])[0];
        
        $warehouse_entry->setQuantity($entry['quantity']);
        $warehouse_entry->setMinQuantity($entry['min_quantity']);
        
        //poslat f-ji wpdateWarehouseProductQuantity
        if($warehouse->updateNewWarehouseProductQuantity($warehouse_entry))
            return new Response($status = 200);
        else
            return new Response($status = 409);//ERROR
        
        
    }
    
    //public function postProductsAction()
    
    
    
}