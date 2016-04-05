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
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ExistenteController
 * @package InventarioBundle\Controller
 * @Route("/existente", name="inventario_existente")
 */
class ExistenteController extends BaseController
{
    /**
     * @return JsonResponse
     * @Route("/", name="inventario_existent_lista")
     * @Method("GET")
     */
    public function indexAction() {
        $inventarios = $this->getDoctrine()
            ->getRepository("InventarioBundle:InventarioMaterial")
            ->findBy([], ['material' => 'ASC']);

        $data = ["inventarios" => $inventarios];
        $response = $this->apiResponse($data);

        return $response;
    }

    /**
     * Muestra el detalles de todas las transacciones realizadas al inventario
     * en la bodega
     *
     * @return JsonResponse
     * @param integer $materialId
     * @param integer $bodegaId
     * @Route("/material/{materialId}/bodega/{bodegaId}", name="inventario_existente_ver")
     * @Method("GET")
     */
    public function verAction($materialId, $bodegaId) {

        $error = [];

        $material = $this->getDoctrine()
            ->getRepository('AdministracionBundle:Material')
            ->findOneBy(["id" => $materialId]);

        if(!$material)
            $error[] = "Inventario para Material (id:{$materialId}) no encontrado";

        $bodega = $this->getDoctrine()
            ->getRepository('AdministracionBundle:Bodega')
            ->findOneBy(["id" => $bodegaId]);

        if(!$bodega)
            $error[] = "Inventario para Bodega (id:{$materialId}) no encontrado";

        $inventario = $this->getDoctrine()
            ->getRepository('InventarioBundle:InventarioMaterial')
            ->findOneBy([
                "material" => $material,
                "bodega" => $bodega
            ]);


        $movimientos = $this->getDoctrine()
            ->getRepository('InventarioBundle:MovimientoMaterial')
            ->findBy(
                ["bodega" => $bodega, "material" => $material],
                ["fecha" => "DESC"]
            );

        if(count($error) == 0) {
            $data = [
                "inventario" => $inventario,
                "movimientos" => $movimientos
            ];

            $response = $this->apiResponse($data, 200, JSON_SIMPLE);
        }
        else
            $response = $this->apiResponse($error, 404, JSON_SIMPLE);

        return $response;
    }

    /**
     * @Route("/bodega/{id}")
     * @Method("GET")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bodegaAction($id) {
        $bodega = $this->getDoctrine()
            ->getRepository("AdministracionBundle:Bodega")
            ->findOneBy(["id" => $id]);

        if($bodega) {
            $inventarios = $this->getDoctrine()
                ->getRepository("InventarioBundle:InventarioMaterial")
                ->findByBodega($bodega);

            $data = ["inventarios" => $inventarios];
            $response = $this->apiResponse($data);
        }
        else
        {
            $response = $this->apiResponse("Inventario no encontrado (b:id).", 400);
        }

        return $response;
    }

    /**
     * @Route("/material/{id}")
     * @Method("GET")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function MaterialAction($id) {
        $material = $this->getDoctrine()
            ->getRepository("AdministracionBundle:Material")
            ->findOneBy(["id" => $id]);

        if($material) {
            $inventarios = $this->getDoctrine()
                ->getRepository("InventarioBundle:InventarioMaterial")
                ->findByMaterial($material);

            $data = ["inventarios" => $inventarios];
            $response = $this->apiResponse($data);
        }
        else {
            $response = $this->apiResponse("Inventario no encontrado (b:id).", 400);
        }

        return $response;
    }
}