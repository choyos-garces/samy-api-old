<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/29/2016
 * Time: 8:41 PM
 */

namespace InventarioBundle\Controller;

use InventarioBundle\Entity\InventarioMaterial;
use InventarioBundle\Entity\MovimientoInventario;

use InventarioBundle\Entity\MovimientoInventarioDetalle;
use InventarioBundle\Entity\MovimientoMaterial;
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
            ->findBy([], ["fecha" => "DESC"]);

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
            ->findOneBy(array("id" => $id));

        if(!$movimiento)
            $response = $this->apiResponse("Movimiento de Inventario (id:{$id}) no encontrado", 404);
        else
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
        
        /** @var MovimientoMaterial[] $movimeintosMateriales */
        $movimeintosMateriales = [];

        /** @var array $inventarios */
        $inventarios = [];
        $errors = [];

        // Chequea que la bodega existe
        $bodega = $this->getDoctrine()
            ->getRepository("AdministracionBundle:Bodega")
            ->findOneBy(array("id" => $payload->bodega->id));

        // Chequea datos del detalle
        $detalles = new MovimientoInventarioDetalle();
        switch ($payload->motivoMovimiento->id) {
            case 1 :
                $detalleProveedor = $this->getDoctrine()
                    ->getRepository("AdministracionBundle:Empresa")
                    ->findOneBy(["id" => $payload->detalles->proveedor->id]);

                $detalles->setFactura($payload->detalles->factura);
                $detalles->set
                if(!$detalleProveedor) $errors [] = "Detalle de Proveedor equivocado";
                break;
            case 2 :
                break;
            case 3 :
                break;
            case 4 :
                break;
            case 5 :
                break;
            case 6 :
                break;
        }

        // Primero revisa el Request por el movimiento de material
        // Si no hay movimientos de materiales deberia retornar un error de inmediato
        foreach ($payload->movimientosMateriales as $movimientoMaterial)
        {
            $error = false;
            $material = $this->getDoctrine()
                ->getRepository("AdministracionBundle:Material")
                ->findOneBy(array("id" => $movimientoMaterial->material->id));

            if($material && $bodega) {

                $inventario = $this->getDoctrine()
                    ->getRepository("InventarioBundle:InventarioMaterial")
                    ->findOneBy(array(
                        "material" => $material,
                        "bodega" => $bodega
                    ));

                if($inventario) {
                    $inventarioExistente  = floatval($inventario->getCantidad());
                    // 0 es Egreso; 1 es Ingreso
                    if($payload->tipoMovimiento == 0 && $inventarioExistente < $movimientoMaterial->cantidad ) {
                        $error = "No hay inventario sufficiente de {$material->getNombre()} (id:{$material->getId()}) para la transacción.";
                    }
                    else if($payload->tipoMovimiento == 0 && $inventarioExistente >= $movimientoMaterial->cantidad ) {
                        $nuevoInventario = $inventarioExistente - $movimientoMaterial->cantidad;
                        $inventario->setCantidad($nuevoInventario);
                    }
                    if($payload->tipoMovimiento == 1 ) {
                        $nuevoInventario = $inventarioExistente + $movimientoMaterial->cantidad;
                        $inventario->setCantidad($nuevoInventario);
                    }
                }
                else
                {
                    $inventarioExistente = 0;
                    if($payload->tipoMovimiento == 0) {
                        $error = "No hay inventario sufficiente de {$material->getNombre()} (id:{$material->getId()}) para la transacción.";
                    }
                    if($payload->tipoMovimiento == 1 ) {
                        $inventario = new InventarioMaterial();
                        $inventario->setCantidad($movimientoMaterial->cantidad);
                        $inventario->setMaterial($material);
                        $inventario->setBodega($bodega);
                    }
                }
            }
            else
            {
                $error ="Material {$material->getNombre()} (id:{$material->getId()}) o Bodega {$bodega->getNombre()} (id:{$bodega->getId()}) no existen";
            }

            // Si no hubo errores:
            // - Genrar un movimiento de material
            // - Preparar el nuevo inventario de material para persistir
            if($error == false) {
                $log = new MovimientoMaterial();
                $log->setTipoMovimiento($payload->tipoMovimiento);
                $log->setBodega($bodega);
                $log->setMaterial($material);
                $log->setCantidadPrevia($inventarioExistente);
                $log->setCantidad($movimientoMaterial->cantidad);

                $movimeintosMateriales[] = $log;
                $inventarios[] = $inventario;
            }
            else {
                $errors[] = $error;
            }
        }

        if(count($errors) == 0 ) {
            $motivoMovimiento = $this->getDoctrine()
                ->getRepository("ControlPanelBundle:MotivoMovimientoInventario")
                ->findOneBy(array("id" => $payload->motivoMovimiento->id));

            $em = $this->getDoctrine()->getManager();
            $em->persist($detalles);

            $movimiento = new MovimientoInventario();
            $movimiento->setTipoMovimiento($payload->tipoMovimiento);
            $movimiento->setBodega($bodega);
            $movimiento->setMotivoMovimiento($motivoMovimiento);
            $movimiento->setNotas($payload->notas);
            $movimiento->setDetalle($detalles);

            $em->persist($movimiento);

            // Persiste los nuevos valores para el invetario y asigna el nuevo movimiento inventario
            // a los movimeintos de materiales para el registro
            for($i = 0; $i < count($inventarios); $i++) {
                $movimeintosMateriales[$i]->setMovimientoInventario($movimiento);

                $em->persist($inventarios[$i]);
                $em->persist($movimeintosMateriales[$i]);
            }

            $em->flush();
            $em->clear();

            $movimiento = $this->getDoctrine()
                ->getRepository("InventarioBundle:MovimientoInventario")
                ->findOneBy(array("id" => $movimiento->getId()));

            $movimeintoURL = $this->generateUrl(
                "inventario_movimiento_ver",
                ["id" => $movimiento->getId()]
            );
            
            $response = $this->apiResponse($movimiento, 201);
            $response->headers->set("Location", $movimeintoURL);

            $this->sendMail(
                "Do not reply: Notificacion de Movimiento de Inventario",
                "choyos.garces@gmail.com",
                "@Inventario/Movimientos/ingresarAction.html.twig",
                $movimiento
            );

        }
        else {
           $response = $this->apiResponse($errors, 400);
        }

        return $response;
    }
    
}