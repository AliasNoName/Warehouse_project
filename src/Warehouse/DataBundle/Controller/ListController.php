<?php

namespace Warehouse\DataBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ListController extends Controller
{
    // GET */lists/
    /**
     * @return array
     * @View()
     */
    public function getListAction()
    {
        $data = $this->get('list_functions')->getAllLists();
        
        //if(empty($data))
        //    throw new NotFoundHttpException('Sorry not existing!');
        return array('lists'=> $data);
    }
    
    // GET */list/{{$id}}
    /**
     * @return array
     * @var integer $id warehouseEntry of entity
     * @View()
     */
    public function getListsAction($id)
    {
        $list = $this->get('list_functions');
        $entry = $list->getDetailedList($id);
        return array('list' => $entry);
    }
    
    public function postListsAction(Request $req)
    {
        $productsList = $req->get('data');
        $cafe = json_decode($req->get('cafe'), true);
        
        $list = $this->get('list_functions');
        $result = $list->addNewProductsList($productsList, $cafe);
        if($result)
            return new Response($status = 200);
    }
    
}