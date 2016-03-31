<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/21/2016
 * Time: 4:55 PM
 */

namespace AdministracionBundle\Controller;


use AdministracionBundle\Entity\Material;
use ControlPanelBundle\Entity\TipoOpcion;
use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class MaterialesController
 * @package AdministracionBundle\Controller
 * @Route("/materiales", name="materiales")
 */
class MaterialesController extends BaseController
{

    /**
     * @Route("/", name="materiales_index")
     * @return Response
     */
    public function indexAction() {
        $materiales= $this->getDoctrine()->getRepository('AdministracionBundle:Material')->findAll();

        $response = $this->apiResponse($materiales);
        return $response;
    }

    /**
     * @Route("/ingresar", name="materiales_ingresar")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function ingresarAction(Request $request) {
        $payload = json_decode($request->getContent());

        $tipoMaterial = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findOneBy(array("id" => $payload->tipoMaterial->id));

        $material = new Material();
        $material->setCodigo($payload->codigo);
        $material->setNombre($payload->nombre);
        $material->setTipoMaterial($tipoMaterial);

        $em = $this->getDoctrine()->getManager();
        $em->persist($material);
        $em->flush();

        $materialUrl = $this->generateUrl(
            "materiales_ver",
            ["id" => $material->getId()]
        );
        $response = $this->apiResponse($material, 201);
        $response->headers->set('Location', $materialUrl);

        return $response;
    }


    /**
     * @Route("/{id}", name="materiales_ver")
     * @Method("GET")
     * @param $id
     * @return Response
     */
    public function verAction($id) {
        $material = $this->getDoctrine()->getRepository('AdministracionBundle:Material')->findOneBy(array("id" => $id));

        $response = $this->apiResponse($material);
        return $response;
    }
}