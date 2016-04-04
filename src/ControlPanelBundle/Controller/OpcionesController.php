<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/22/2016
 * Time: 6:08 PM
 */

namespace ControlPanelBundle\Controller;


use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OpcionesController
 * @package ControlPanelBundle\Controller
 * @Route("/opciones")
 */
class OpcionesController extends BaseController
{
    /**
     * @Route("/tiposMaterial")
     * @Method("GET")
     * @return JsonResponse
     */
    public function tiposMaterialAction() {
        $tiposMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "TIPO_MATERIAL"));
        $response = $this->apiResponse($tiposMaterial);

        return $response;
    }

    /**
     * @Route("/tiposIdentificacion")
     * @Method("GET")
     * @return JsonResponse
     */
    public function tiposIdentificacionAction() {
        $tiposIdentificacion = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "IDENTIFICACION"));
        $response = $this->apiResponse($tiposIdentificacion);

        return $response;
    }

    /**
     * @Route("/tiposProductosPlantacion")
     * @Method("GET")
     * @return JsonResponse
     */
    public function tipoProductoPlantacionAction() {
        $plantacionDetalle = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "PLANTACION_DETALLE"));
        $response = $this->apiResponse($plantacionDetalle);

        return $response;
    }

    /**
     * @Route("/productosPlantacion")
     * @Method("GET")
     * @return JsonResponse
     */
    public function productosPlantacionAction() {
        $tiposPlantacion = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "TIPO_PLANTACION"));
        $response = $this->apiResponse($tiposPlantacion);

        return $response;
    }

    /**
     * @Route("/unidadesArea")
     * @Method("GET")
     * @return JsonResponse
     */
    public function unidadesAreaAction() {
        $unidades = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findBy(array("grupo" => "UNIDADES_AREA"));
        $response = $this->apiResponse($unidades);

        return $response;
    }

    /**
     * @Route("/motivosMovimientoInventario")
     * @Method("GET")
     * @return JsonResponse
     */
    public function motivoMovimientoInventarioAction() {
        $motivosMovimeinoInventario = $this->getDoctrine()->getRepository('ControlPanelBundle:MotivoMovimientoInventario')->findAll();

        $response = $this->apiResponse($motivosMovimeinoInventario);
        return $response;
    }

}