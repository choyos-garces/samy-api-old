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

        $material = $this->getDoctrine()
            ->getRepository('AdministracionBundle:Material')
            ->findOneBy(["id" => $materialId]);

        $bodega = $this->getDoctrine()
            ->getRepository('AdministracionBundle:Bodega')
            ->findOneBy(["id" => $bodegaId]);

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

        $data = [
            "inventario" => $inventario,
            "movimientos" => $movimientos
        ];
        return $this->apiResponse($data, 200, JSON_SIMPLE);
    }
}