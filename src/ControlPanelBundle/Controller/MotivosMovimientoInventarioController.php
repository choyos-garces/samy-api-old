<?php

namespace ControlPanelBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;

/**
 * Class TiposMaterial
 * @Route("/motivosMovimientoInventario", name="motivos_movimiento_inventario")
 * @package ControlPanelBundle\Controller
 */
class MotivosMovimientoInventarioController extends Controller
{

    /**
     * @Route("/", name="motivos_movimiento_inventario_index")
     *
     * @return Response
     */
    function indexAction() {
        $motivosMovimeinoInventario = $this->getDoctrine()->getRepository('ControlPanelBundle:MotivoMovimientoInventario')->findAll();

        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize($motivosMovimeinoInventario, "json");

        $response = new Response();
        $response->headers->set("Content-Type", "application/json");
        $response->setContent($data);
        return $response;
    }
}