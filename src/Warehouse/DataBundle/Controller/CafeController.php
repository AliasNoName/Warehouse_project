<?php

namespace Warehouse\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CafeController extends Controller 
{
    /**
     * @return array
     * @View()
     */
    public function getCafeAction()
    {
        $cafe = $this->get('cafe_functions');
        $list = $cafe->getCafeList();
        return array('cafe' => $list);
    }
}