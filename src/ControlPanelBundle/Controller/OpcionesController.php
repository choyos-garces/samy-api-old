<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/22/2016
 * Time: 6:08 PM
 */

namespace ControlPanelBundle\Controller;


use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OpcionesController
 * @package ControlPanelBundle\Controller
 * @Route("/opciones")
 */
class OpcionesController extends Controller
{
    /**
     * @Route("/tiposMaterial")
     * @Method("GET")
     * @return Response 
     */
    public function tiposMaterialAction() {
        $tiposMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "TIPO_MATERIAL"));

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($tiposMaterial, "json");

        $response = new Response();
        $response->headers->set("Content-Type", "application/json");
        $response->setContent($data);
        
        return $response;
    }

    /**
     * @Route("/tiposIdentificacion")
     * @Method("GET")
     * @return Response
     */
    public function tiposIdentificacionAction() {
        $tiposMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "IDENTIFICACION"));

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($tiposMaterial, "json");

        $response = new Response();
        $response->headers->set("Content-Type", "application/json");
        $response->setContent($data);

        return $response;
    }

    /**
     * @Route("/tiposProductosPlantacion")
     * @Method("GET")
     * @return Response
     */
    public function tipoProductoPlantacionAction() {
        $tiposMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "PLANTACION_DETALLE"));

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($tiposMaterial, "json");

        $response = new Response();
        $response->headers->set("Content-Type", "application/json");
        $response->setContent($data);

        return $response;
    }

    /**
     * @Route("/productosPlantacion")
     * @Method("GET")
     * @return Response
     */
    public function productosPlantacionAction() {
        $tiposMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "TIPO_PLANTACION"));

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($tiposMaterial, "json");

        $response = new Response();
        $response->headers->set("Content-Type", "application/json");
        $response->setContent($data);

        return $response;
    }

    /**
     * @Route("/unidadesArea")
     * @Method("GET")
     * @return Response
     */
    public function unidadesAreaAction() {
        $tiposMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "UNIDADES_AREA"));

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($tiposMaterial, "json");

        $response = new Response();
        $response->headers->set("Content-Type", "application/json");
        $response->setContent($data);

        return $response;
    }
}