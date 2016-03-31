<?php
namespace AdministracionBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Plantacion
 *
 * @ORM\Entity(repositoryClass="AdministracionBundle\Repository\PlantacionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Plantacion
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
     * @ORM\Column(type="string", length=28)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Empresa", inversedBy="plantaciones")
     */
    private $propietario;

    /**
     * @ORM\ManyToOne(targetEntity="ControlPanelBundle\Entity\TipoOpcion")
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id")
     */
    private $producto;

    /**
     * @ORM\ManyToOne(targetEntity="ControlPanelBundle\Entity\TipoOpcion")
     * @ORM\JoinColumn(name="tipo_producto_id", referencedColumnName="id")
     */
    private $tipoProducto;

    /**
     * @ORM\Column(type="decimal", scale=2, precision=9)
     */
    private $tamano;

    /**
     * @ORM\ManyToOne(targetEntity="ControlPanelBundle\Entity\TipoOpcion")
     * @ORM\JoinColumn(name="unidad_id", referencedColumnName="id")
     */
    private $unidad;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tamano
     *
     * @param string $tamano
     *
     * @return Plantacion
     */
    public function setTamano($tamano)
    {
        $this->tamano = $tamano;

        return $this;
    }

    /**
     * Get tamano
     *
     * @return string
     */
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Plantacion
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
     * Set propietario
     *
     * @param \AdministracionBundle\Entity\Empresa $propietario
     *
     * @return Plantacion
     */
    public function setPropietario(\AdministracionBundle\Entity\Empresa $propietario = null)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return \AdministracionBundle\Entity\Empresa
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * Set producto
     *
     * @param \ControlPanelBundle\Entity\TipoOpcion $producto
     *
     * @return Plantacion
     */
    public function setProducto(\ControlPanelBundle\Entity\TipoOpcion $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \ControlPanelBundle\Entity\TipoOpcion
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set tipoProducto
     *
     * @param \ControlPanelBundle\Entity\TipoOpcion $tipoProducto
     *
     * @return Plantacion
     */
    public function setTipoProducto(\ControlPanelBundle\Entity\TipoOpcion $tipoProducto = null)
    {
        $this->tipoProducto = $tipoProducto;

        return $this;
    }

    /**
     * Get tipoProducto
     *
     * @return \ControlPanelBundle\Entity\TipoOpcion
     */
    public function getTipoProducto()
    {
        return $this->tipoProducto;
    }

    /**
     * Set unidad
     *
     * @param \ControlPanelBundle\Entity\TipoOpcion $unidad
     *
     * @return Plantacion
     */
    public function setUnidad(\ControlPanelBundle\Entity\TipoOpcion $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \ControlPanelBundle\Entity\TipoOpcion
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Plantacion
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
}
