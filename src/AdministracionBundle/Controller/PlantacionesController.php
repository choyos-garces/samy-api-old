<?php
namespace AdministracionBundle\Controller;

use AdministracionBundle\Entity\Plantacion;
use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EmpresasController
 * @package AdministracionBundle\Controller
 * @Route("/plantaciones", name="plantaciones")
 */
class PlantacionesController extends BaseController
{

    /**
     * @return JsonResponse
     * @Route("/", name="plantacions_index")
     * @Method("Get")
     */
    public function indexAction() {
        $plantaciones = $this->getDoctrine()->getRepository('AdministracionBundle:Plantacion')->findAll();

        $response = $this->apiResponse($plantaciones);

        return $response;
    }

    /**
     * @param $id integer
     * @return JsonResponse
     * @Route("/{id}", name="plantacion_ver")
     * @Method("GET")
     */
    public function verAction($id) {
        $plantacion = $this->getDoctrine()->getRepository('AdministracionBundle:Plantacion')->findOneBy(array("id" => $id));

        $response = $this->apiResponse($plantacion);
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/ingresar", name="plantacion_ingresar")
     * @Method("POST")
     */
    public function ingresarAction(Request $request) {
        $payload = json_decode($request->getContent());
        $propietario = $this->getDoctrine()->getRepository('AdministracionBundle:Empresa')->findOneBy(array("id" => $payload->propietario->id));
        $producto = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findOneBy(array("id" => $payload->producto->id));
        $tipoProducto = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findOneBy(array("id" => $payload->tipoProducto->id));
        $unidad = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findOneBy(array("id" => $payload->unidad->id));

        $plantacion = new Plantacion();
        $plantacion->setPropietario($propietario);
        $plantacion->setNombre($payload->nombre);
        $plantacion->setProducto($producto);
        $plantacion->setTipoProducto($tipoProducto);
        $plantacion->setTamano($payload->tamano);
        $plantacion->setUnidad($unidad);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($plantacion);
        $em->flush();

        $plantacionURL = $this->generateUrl("plantacion_ver", ["id" => $plantacion->getId()]);
        $response = $this->apiResponse($plantacion, 201);
        $response->headers->set("Location", $plantacionURL);

        return $response;
    }
}