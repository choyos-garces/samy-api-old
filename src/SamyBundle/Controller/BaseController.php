<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/29/2016
 * Time: 7:46 PM
 */

namespace SamyBundle\Controller;

define('JSON_SIMPLE', 0);
define('JSON_JMS', 1);

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    
    protected function apiResponse($data, $statuscode = 200, $serializer = JSON_JMS)
    {
        $json = $this->serializer($data, $serializer);

        $response = new Response($json, $statuscode, [
           "Content-Type" => "application/json"
        ]);
        
        return $response;
    }

    protected function serializer($data, $type)
    {
        if($type == JSON_SIMPLE) return json_encode($data);
        return $this->get("jms_serializer")->serialize($data, 'json');
    }


    protected function processForm(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
    }
}