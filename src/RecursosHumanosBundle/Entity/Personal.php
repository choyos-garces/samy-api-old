<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 4/25/2016
 * Time: 1:37 PM
 */

namespace RecursosHumanosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personal
 *
 * @ORM\Entity(repositoryClass="RecursosHumanosBundle\Repository\PersonalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Personal
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $primerNombre;

    /**
     * @var string
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $segundoNombre;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $primerApellido;

    /**
     * @var string
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $segundoApellido;

    /**
     * @var string
     * @ORM\Column(type="string", length=24)
     */
    private $cedula;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $correoPersonal;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $correroEmpresa;

    /**
     * @var string
     * @ORM\Column(type="string", length=24)
     */
    private $telefono;

    /**
     * @var string
     * @ORM\Column(type="string", length=24)
     */
    private $telefonoEmpresa;

    /**
     * @var /DateTime
     * @ORM\Column(type="date")
     */
    private $desde;
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set primerNombre
     *
     * @param string $primerNombre
     *
     * @return Personal
     */
    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     *
     * @return Personal
     */
    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get segundoNombre
     *
     * @return string
     */
    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return Personal
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return Personal
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Personal
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set correoPersonal
     *
     * @param string $correoPersonal
     *
     * @return Personal
     */
    public function setCorreoPersonal($correoPersonal)
    {
        $this->correoPersonal = $correoPersonal;

        return $this;
    }

    /**
     * Get correoPersonal
     *
     * @return string
     */
    public function getCorreoPersonal()
    {
        return $this->correoPersonal;
    }

    /**
     * Set correroEmpresa
     *
     * @param string $correroEmpresa
     *
     * @return Personal
     */
    public function setCorreroEmpresa($correroEmpresa)
    {
        $this->correroEmpresa = $correroEmpresa;

        return $this;
    }

    /**
     * Get correroEmpresa
     *
     * @return string
     */
    public function getCorreroEmpresa()
    {
        return $this->correroEmpresa;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Personal
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set telefonoEmpresa
     *
     * @param string $telefonoEmpresa
     *
     * @return Personal
     */
    public function setTelefonoEmpresa($telefonoEmpresa)
    {
        $this->telefonoEmpresa = $telefonoEmpresa;

        return $this;
    }

    /**
     * Get telefonoEmpresa
     *
     * @return string
     */
    public function getTelefonoEmpresa()
    {
        return $this->telefonoEmpresa;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->desde = new \DateTime();
    } 

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return Personal
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime
     */
    public function getDesde()
    {
        return $this->desde;
    }
}
