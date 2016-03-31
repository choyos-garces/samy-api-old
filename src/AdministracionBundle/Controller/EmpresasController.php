<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/21/2016
 * Time: 4:55 PM
 */

namespace AdministracionBundle\Controller;

use AdministracionBundle\Entity\Empresa;
use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EmpresasController
 * @package AdministracionBundle\Controller
 * @Route("/empresas", name="empresas")
 */
class EmpresasController extends BaseController
{

    /**
     * @param $tipoEmpresa string
     * @return JsonResponse
     * @Route("/tipo/{tipoEmpresa}", name="empresas_index")
     * @Method("Get")
     */
    public function indexAction($tipoEmpresa) {
        $empresas = $this->getDoctrine()->getRepository('AdministracionBundle:Empresa')->findBy(array("tipoEmpresa" => $tipoEmpresa));

        $response = $this->apiResponse($empresas);
        return $response;
    }

    /**
     * @param $id integer
     * @return JsonResponse
     * @Route("/{id}", name="empresa_ver")
     * @Method("GET")
     */
    public function verAction($id) {
        $empresa = $this->getDoctrine()->getRepository('AdministracionBundle:Empresa')->findOneBy(array("id" => $id));

        $response = $this->apiResponse($empresa);
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/ingresar", name="empresa_ingresar")
     * @Method({"POST"})
     */
    public function ingresarAction(Request $request) {
        $payload = json_decode($request->getContent());
        $tipoIdentificacion = $this->getDoctrine()->getRepository('ControlPanelBundle:TipoOpcion')->findOneBy(array("id" => $payload->tipoIdentificacion->id));

        $empresa = new Empresa();
        $empresa->setTipoEmpresa($payload->tipoEmpresa);
        $empresa->setRazonSocial($payload->razonSocial);
        $empresa->setIdentificacion($payload->identificacion);
        $empresa->setTipoIdentificacion($tipoIdentificacion);
        $empresa->setTelefono($payload->telefono);
        $empresa->setCorreo($payload->correo);
        $empresa->setDireccion($payload->direccion);

        $em = $this->getDoctrine()->getManager();
        $em->persist($empresa);
        $em->flush();

        $empresaURL = $this->generateUrl("empresa_ver", ["id" => $empresa->getId()]);
        $response = $this->apiResponse($empresa, 201);
        $response->headers->set("Location", $empresaURL);

        return $response;
    }

}