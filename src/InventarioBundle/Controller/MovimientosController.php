<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/29/2016
 * Time: 8:41 PM
 */

namespace InventarioBundle\Controller;

use AdministracionBundle\Entity\Bodega;
use AdministracionBundle\Entity\Material;
use ControlPanelBundle\Entity\MotivoMovimientoInventario;
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
        
        // Para evitar problemas inicializa los arrays necesarios para el proceso
        $movimeintosMateriales = [];
        $inventarios = [];
        $errores = [];

        // Chequea datos del detalle
        $motivoMovimiento = $this->getDoctrine()
            ->getRepository("ControlPanelBundle:MotivoMovimientoInventario")
            ->findOneBy(array("id" => $payload->motivoMovimiento->id));
        
        // Chequea que la bodega en el request exista
        $bodega = $this->getDoctrine()
            ->getRepository("AdministracionBundle:Bodega")
            ->findOneBy(array("id" => $payload->bodega->id));
        
        //Feedback de la bodega
        if($bodega == null)
            $errores[] = "Bodega {$payload->bodega->nombre} (id:{$payload->bodega->id}) no existe.";
        
        // Itera la lista de movimientos de material en el request
        foreach ($payload->movimientosMateriales as $mm)
        {
            $error = null;
            $tipo = $payload->tipoMovimiento;
            $cantidad = $mm->cantidad;
            
            // Revisa que el material en request exista
            $material = $this->getDoctrine()
                ->getRepository("AdministracionBundle:Material")
                ->findOneBy(array("id" => $mm->material->id));
            
            // Feedback del material
            if($material == null)
                $error = "Material {$mm->material->nombre} (id:{$mm->material->id}) no existe.";
            
            // Si no hubo errores:
            // - Chequear el inventario
            // - Genrar un movimiento de material
            // - Preparar el nuevo inventario de material para persistir
            if($error == null) {
                $inventario = $this->checkoutInventario($bodega, $material, $cantidad, $tipo);
                
                if($inventario) {
                    $cantidadNueva = floatval($inventario->getCantidad());
                    $cantidadPrevia = ($tipo) ? $cantidadNueva - $cantidad : $cantidadNueva + $cantidad;
                    $movimientoMaterial = new MovimientoMaterial();
                    $movimientoMaterial->setTipoMovimiento($tipo);
                    $movimientoMaterial->setBodega($bodega);
                    $movimientoMaterial->setMaterial($material);
                    $movimientoMaterial->setCantidadPrevia($cantidadPrevia);
                    $movimientoMaterial->setCantidad($cantidad);
                    $movimeintosMateriales[] = $movimientoMaterial;
                    $inventarios[] = $inventario;
                }
                else {
                    $errores[] = "No hay suficiente Inventario de {$material->getNombre()} en la bodega {$bodega->getNombre()}.";
                }
            }
            else {
                $errores[] = $error;
            }
        }

        // Chequea los detalles del formulario
        $detalle = $this->handleDetalleMovimiento($motivoMovimiento, $payload->detalle, $bodega);
        if(is_array($detalle)) $errores [] = array_merge($errores, $detalle);

        // Si no hay errores
        // Cominenza a Persistir la informacion generada en la base de datos
        if(count($errores) == 0 ) {
            // Persiste Detalles del Movimiento
            $em = $this->getDoctrine()->getManager();
            $em->persist($detalle);

            // Persiste el movimiento
            $movimiento = new MovimientoInventario();
            $movimiento->setTipoMovimiento($payload->tipoMovimiento);
            $movimiento->setBodega($bodega);
            $movimiento->setMotivoMovimiento($motivoMovimiento);
            $movimiento->setNotas($payload->notas);
            $movimiento->setDetalle($detalle);

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

            $this->handleIngresoInventarioFeedback($movimiento);
            
            $response = $this->apiResponse($movimiento, 201);
            $response->headers->set("Location", $movimeintoURL);
        }
        else {
           $response = $this->apiResponse($errores, 400);
        }

        return $response;
    }
    
    /**
     * @param Bodega $bodega
     * @param Material $material
     * @param float $cantidad
     * @param int $tipo Donde 1 es ingreso y 0 egreso
     * @return InventarioMaterial|null
     */
    private function checkoutInventario(Bodega $bodega, Material $material, $cantidad, $tipo) {
        $inventario = $this->getDoctrine()
            ->getRepository("InventarioBundle:InventarioMaterial")
            ->findByInventario($material, $bodega);

        if($inventario) {
            $cantidadExistente = floatval($inventario->getCantidad());

            if($tipo == 1) $nuevaCantidad = $cantidadExistente + $cantidad;
            elseif ( $tipo == 0 && $cantidadExistente >= $cantidad) $nuevaCantidad = $cantidadExistente - $cantidad;
            else return null;

            $inventario->setCantidad($nuevaCantidad);
            return $inventario;
        }
        else {
            return null;
        }
    }

    /**
     * @param MotivoMovimientoInventario $motivo
     * @param Bodega $bodega
     * @param \stdClass $payload
     * @return MovimientoInventarioDetalle|string
     */
    private function handleDetalleMovimiento(MotivoMovimientoInventario $motivo, \stdClass $payload, Bodega $bodega) {
        $detalle = new MovimientoInventarioDetalle();
        $errores = [];

        switch ($motivo->getId()) {
            case 1 : // Ingreso por proveedor
                $proveedor = $this->getDoctrine()
                    ->getRepository("AdministracionBundle:Empresa")
                    ->findOneBy(["id" => $payload->proveedor->id]);

                if($proveedor == null) {
                    $errores[] = "Proveedor selecionado no es válido.";
                }
                else {
                    $detalle->setFactura($payload->factura);
                    $detalle->setProveedor($proveedor);
                }

                break;
            case 2 : // Ingreso desde una Bodega
                $bodegaOrigen = $this->getDoctrine()
                    ->getRepository("AdministracionBundle:Bodega")
                    ->findOneBy(["id" => $payload->bodega->id]);

                if($bodegaOrigen == null ) {
                    $errores[] = "Bodega selecionada no es válida.";
                }
                else {
                    $confirmacion = $payload->confirmacion;
                    $confirmacionOrigen = $this->getDoctrine()
                        ->getRepository("InventarioBundle:MovimientoInventarioDetalle")
                        ->findOneBy(array(
                            "confirmacion" => $confirmacion,
                            "bodega" => $bodega
                        ));
                    if($confirmacionOrigen == null) {
                        $errores[] = "No Existe una transferencia pendiente con ese numero de confirmación para la bodega {$bodega->getNombre()}.";
                    }
                    elseif(strcmp($confirmacion, $confirmacionOrigen->getConfirmacion()) == 0) {
                        $detalle->setBodega($bodega);
                        $detalle->setConfirmacion($confirmacion);
                    }
                    else {
                        $errores[] = "Número de confirmación {$confirmacion} inválido.";
                    }
                }
                
                break;
            case 3 :
                
                break;
            case 4 : // Egreso a un productor
                     
                break;
            case 5 : // Egreso a una bodega
                $bodega = $this->getDoctrine()
                    ->getRepository("AdministracionBundle:Bodega")
                    ->findOneBy(["id" => $payload->bodega->id]);

                if($bodega == null) {
                    $errores[] = "Bodega selecionada es inválida.";
                }
                else {
                    $confirmacion = $this->randomString(8);
                    $detalle->setBodega($bodega);
                    $detalle->setConfirmacion($confirmacion);
                }
                
                break;
            case 6 :
                $proveedor = $this->getDoctrine()
                    ->getRepository("AdministracionBundle:Empresa")
                    ->findOneBy(["id" => $payload->proveedor->id]);

                if($proveedor == null)
                {
                    $errores[] = "Proveedor selecionado es inválido.";
                }
                else {
                    $detalle->setProveedor($proveedor);
                }
                
                break;
        }

        return (count($errores) == 0) ? $errores : $detalle;
    }

    /**
     * @param MovimientoInventario $movimiento
     */
    private function handleIngresoInventarioFeedback(MovimientoInventario $movimiento) {
        $motivo = $movimiento->getMotivoMovimiento()->getId();

        // Siempre manda un correo al contador
        $this->sendMail(
            "Notificacion de Movimiento de Inventario",
            [$this->getParameter("contador")],
            "@Inventario/Movimientos/ingresarAction.html.twig", $movimiento
        );
        
    }
}