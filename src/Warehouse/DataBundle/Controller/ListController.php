<?php

namespace Warehouse\DataBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ListController extends Controller
{
    // GET */lists/
    public function getListsAction()
    {
        $data = $this->get('list_functions')->getAllLists();
        
        if(empty($data))
            throw new NotFoundHttpException('Sorry not existing!');
        return array('lists'=> $data);
    }
    
    // GET */list/{{$id}}
    public function getListAction(Request $req)
    {
        $list = $this->get('list_functions');
        return $list->getDetailedList($req->get['list_entry']); //jos treba provjerit sta je angular poslao
    }
    
    
}