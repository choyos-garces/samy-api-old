<?php
namespace AdministracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa Contacto
 *
 * @ORM\Entity(repositoryClass="AdministracionBundle\Repository\EmpresaContactoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Contacto
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
    private $nombre;

    /**
     * @var string
     * @ORM\Column(type="string", length=18)
     */
    private $celular;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, length=18)
     */
    private $telefono;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, length=64)
     */
    private $correo;
    
    /**
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Empresa", inversedBy="contactos")
     */
    private $empresa;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $estado;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return EmpresaContacto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return EmpresaContacto
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return EmpresaContacto
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
     * Set correo
     *
     * @param string $correo
     *
     * @return EmpresaContacto
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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return EmpresaContacto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EmpresaContacto
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
     * Set empresa
     *
     * @param \AdministracionBundle\Entity\Empresa $empresa
     *
     * @return EmpresaContacto
     */
    public function setEmpresa(\AdministracionBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AdministracionBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
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
}
