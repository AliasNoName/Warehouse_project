<?php

namespace Warehouse\DataBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListController extends Controller
{
    // GET */lists/
    public function getListsAction()
    {
        return $this->get('list_functions')->getAllLists();
    }
    
    // GET */list/{{$id}}
    public function getListAction(Request $req)
    {
        $list = $this->get('list_functions');
        return $list->getDetailedList($req->get['list_entry']); //jos treba provjerit sta je angular poslao
    }
}