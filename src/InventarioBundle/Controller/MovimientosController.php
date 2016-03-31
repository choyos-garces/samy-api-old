<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/29/2016
 * Time: 8:41 PM
 */

namespace InventarioBundle\Controller;

use InventarioBundle\Entity\MovimientoInventario;

use InventarioBundle\Entity\MovimientoMaterial;
use InventarioBundle\Form\MovimientoInventarioType;
use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MovimientosController
 * @package InventarioBundle\Controller
 * @Route("/movimientos", name="inventario_movimiento")
 */
class MovimientosController extends BaseController
{
    /**
     * @return JsonResponse
     * @Route("/", name="inventario_movimiento_index")
     * @Method("GET")
     */
    public function indexAction() {
        $movimientos = $this->getDoctrine()
            ->getRepository("InventarioBundle:MovimientoInventario")
            ->findAll();

        $response = $this->apiResponse(["movimientos" => $movimientos]);
        
        return $response;
    }


    /**
     * @param $id
     * @return JsonResponse
     * @Route("/{id}", name="inventario_movimiento_ver")
     * @Method("GET")
     */
    public function verAction($id) {
        $movimiento = $this->getDoctrine()
            ->getRepository("InventarioBundle:MovimientoInventario")
            ->findBy(array("id" => $id));

        if(!$movimiento)
            throw $this->createNotFoundException("Movimiento de Inventario (id:{$id}) no encontrado");

        $response = $this->apiResponse($movimiento);
        
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/ingresar", name="inventario_movimiento_ingresar")
     * @Method("POST")
     */
    public function ingresarAction(Request $request) {
        $payload = json_decode($request->getContent());

        
        
        
        
        $bodega = $this->getDoctrine()->getRepository("AdministracionBundle:Bodega")->findOneBy(array("id" => $payload->bodega->id));
        $motivoMovimiento = $this->getDoctrine()->getRepository("ControlPanelBundle:MotivoMovimientoInventario")->findOneBy(array("id" => $payload->motivoMovimiento->id));
        
        $movimiento = new MovimientoInventario();
        $movimiento->setTipoMovimiento($payload->tipoMovimiento);
        $movimiento->setBodega($bodega);
        $movimiento->setMotivoMovimiento($motivoMovimiento);

        $em = $this->getDoctrine()->getManager();
        $em->persist($movimiento);
        $em->flush();

        foreach ($payload->movimientosMateriales as $movimientoMaterial)
        {
            $material = $this->getDoctrine()->getRepository("AdministracionBundle:Material")->findOneBy(array("id" => $movimientoMaterial->material->id));

            $mm = new MovimientoMaterial();
            $mm->setTipoMovimiento($payload->tipoMovimiento);
            $mm->setCantidad($movimientoMaterial->cantidad);
            $mm->setMaterial($material);
            $mm->setMovimientoInventario($movimiento);
            $movimiento->addMovimientosMateriale($mm);
        }
        $em->persist($movimiento);
        $em->flush();


        $movimeintoURL = $this->generateUrl(
            "inventario_movimiento_ver",
            ["id" => $movimiento->getId()]
        );

        $response = $this->apiResponse($movimiento, 201);
        $response->headers->set("Location", $movimeintoURL);

        return $response;
    }
    
}