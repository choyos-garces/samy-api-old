<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 4/1/2016
 * Time: 6:31 PM
 */

namespace InventarioBundle\Controller;


use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ExistenteController
 * @package InventarioBundle\Controller
 * @Route("/existente", name="inventario_existente")
 */
class ExistenteController extends BaseController
{
    /**
     * @Route("/", name="inventario_existent_lista")
     * @Method("GET")
     */
    public function indexAction() {
        $inventarios = $this->getDoctrine()
            ->getRepository("InventarioBundle:InventarioMaterial")
            ->lazyLoadAll();

        $data = ["inventarios" => $inventarios];
        $response = $this->apiResponse($data);

        return $response;
    }
}