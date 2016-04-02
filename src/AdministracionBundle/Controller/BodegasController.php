<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/21/2016
 * Time: 4:55 PM
 */

namespace AdministracionBundle\Controller;


use AdministracionBundle\Entity\Bodega;
use InventarioBundle\Entity\InventarioMaterial;
use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BodegasController
 * @package AdministracionBundle\Controller
 * @Route("/bodegas", name="bodegas")
 */
class BodegasController extends BaseController
{

    /**
     * @return JsonResponse
     * @Route("/", name="bodegas_index")
     * @Method("Get")
     */
    public function indexAction() {
        $bodega = $this->getDoctrine()->getRepository('AdministracionBundle:Bodega')->findAll();

        $response = $this->apiResponse($bodega);
        return $response;
    }

    /**
     * @param $id integer
     * @return JsonResponse
     * @Route("/{id}", name="bodega_ver")
     * @Method("GET")
     */
    public function verAction($id) {
        $bodegas = $this->getDoctrine()->getRepository('AdministracionBundle:Bodega')->findOneBy(array("id" => $id));
        
        $response = $this->apiResponse($bodegas);
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/ingresar", name="bodega_ingresar")
     * @Method("POST")
     */
    public function ingresarAction(Request $request) {
        $payload = json_decode($request->getContent());
        
        $bodega = new Bodega();
        $bodega->setCodigo($payload->codigo);
        $bodega->setNombre($payload->nombre);

        $em = $this->getDoctrine()->getManager();
        $em->persist($bodega);
        
        $materiales = $this->getDoctrine()
            ->getRepository("AdministracionBundle:Material")
            ->findAll();
        
        foreach ($materiales as $material) {
            $inventario = new InventarioMaterial();
            $inventario->setBodega($bodega);
            $inventario->setMaterial($material);
            $inventario->setCantidad(0);
            
            $em->persist($inventario);
        }
        
        $em->flush();
        $em->clear();
        
        $bodegaURL = $this->generateUrl("bodega_ver", ["id" => $bodega->getId()]);
        $response = $this->apiResponse($bodega, 201);
        $response->headers->set("Location", $bodegaURL);

        return $response;
    }
}