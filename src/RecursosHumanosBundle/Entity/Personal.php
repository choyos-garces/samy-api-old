<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 4/25/2016
 * Time: 1:37 PM
 */

namespace RecursosHumanosBundle\Entity;

/**
 * Personal
 *
 * @ORM\Entity(repositoryClass="RecursoHumanosBundle\Repository\PersonalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Personal
{
    private $primerNombre;
    private $segundoNombre;
    private $primerApellido;
    private $segundoApellido;
    private $identificacion;
    
}