<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 4/25/2016
 * Time: 1:35 PM
 */

namespace RecursosHumanosBundle\Controller;


use SamyBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PersonalController
 * @package RecursosHumanosBundle\Controller
 * @Route("personal", name=personal"")
 */
class PersonalController extends BaseController
{

    /**
     * @Route("/", name="lista_personal")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {

        return $this->apiResponse("");
    }

    /**
     * @Route("/{id}", name="ver_personal")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function verAction($id) {
        
        return $this->apiResponse("");
    }

    /**
     * @Route("/ingresar", name="ingresar_personal")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ingresarAction(Request $request) {
        
        return $this->apiResponse("");
    }
}