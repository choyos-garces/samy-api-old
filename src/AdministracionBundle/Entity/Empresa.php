<?php
namespace AdministracionBundle\Entity;

use ControlPanelBundle\Entity\TipoOpcion;
use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Entity(repositoryClass="AdministracionBundle\Repository\EmpresaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Empresa
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=64) 
     */
    private $razonSocial;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=24)
     */
    private $identificacion;

    /**
     * @var string
     * @ORM\Column(type="string", length=18)
     */
    private $telefono;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $correo;

    /**
     * @var
     * @ORM\Column(type="integer", length=8)
     */
    private $tipoEmpresa;

    /**
     * @var TipoOpcion
     * @ORM\ManyToOne(targetEntity="ControlPanelBundle\Entity\TipoOpcion")
     */
    private $tipoIdentificacion;

    /**
     * @ORM\OneToMany(targetEntity="AdministracionBundle\Entity\Contacto", mappedBy="empresa")
     */
    private $contactos;

    /**
     * @ORM\OneToMany(targetEntity="AdministracionBundle\Entity\Plantacion", mappedBy="propietario")
     */
    private $plantaciones;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $fecha;
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->fecha = new \DateTime();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set razonSocial
     *
     * @param string $razonSocial
     *
     * @return Empresa
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set identificacion
     *
     * @param string $identificacion
     *
     * @return Empresa
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Empresa
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Empresa
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Empresa
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipoIdentificacion
     *
     * @param \ControlPanelBundle\Entity\TipoOpcion $tipoIdentificacion
     *
     * @return Empresa
     */
    public function setTipoIdentificacion(\ControlPanelBundle\Entity\TipoOpcion $tipoIdentificacion = null)
    {
        $this->tipoIdentificacion = $tipoIdentificacion;

        return $this;
    }

    /**
     * Get tipoIdentificacion
     *
     * @return \ControlPanelBundle\Entity\TipoOpcion
     */
    public function getTipoIdentificacion()
    {
        return $this->tipoIdentificacion;
    }

    /**
     * Add contacto
     *
     * @param \AdministracionBundle\Entity\Contacto $contacto
     *
     * @return Empresa
     */
    public function addContacto(\AdministracionBundle\Entity\Contacto $contacto)
    {
        $this->contactos[] = $contacto;

        return $this;
    }

    /**
     * Remove contacto
     *
     * @param \AdministracionBundle\Entity\Contacto $contacto
     */
    public function removeContacto(\AdministracionBundle\Entity\Contacto $contacto)
    {
        $this->contactos->removeElement($contacto);
    }

    /**
     * Get contactos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContactos()
    {
        return $this->contactos;
    }

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
     * Set tipoEmpresa
     *
     * @param integer $tipoEmpresa
     *
     * @return Empresa
     */
    public function setTipoEmpresa($tipoEmpresa)
    {
        $this->tipoEmpresa = $tipoEmpresa;

        return $this;
    }

    /**
     * Get tipoEmpresa
     *
     * @return integer
     */
    public function getTipoEmpresa()
    {
        return $this->tipoEmpresa;
    }

    /**
     * Add plantacione
     *
     * @param \AdministracionBundle\Entity\Plantacion $plantacione
     *
     * @return Empresa
     */
    public function addPlantacione(\AdministracionBundle\Entity\Plantacion $plantacione)
    {
        $this->plantaciones[] = $plantacione;

        return $this;
    }

    /**
     * Remove plantacione
     *
     * @param \AdministracionBundle\Entity\Plantacion $plantacione
     */
    public function removePlantacione(\AdministracionBundle\Entity\Plantacion $plantacione)
    {
        $this->plantaciones->removeElement($plantacione);
    }

    /**
     * Get plantaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlantaciones()
    {
        return $this->plantaciones;
    }
}
