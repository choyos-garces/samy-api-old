<?php

namespace AdministracionBundle\Entity;

use ControlPanelBundle\Entity\TipoOpcion;
use Doctrine\ORM\Mapping as ORM;
use InventarioBundle\Entity\InventarioMaterial;

/**
 * Material
 *
 * @ORM\Table(name="material")
 * @ORM\Entity(repositoryClass="AdministracionBundle\Repository\MaterialRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Material
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
     *
     * @ORM\Column(name="codigo", type="string", length=8)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=64)
     */
    private $nombre;

    /**
     * @var TipoOpcion
     * @ORM\ManyToOne(targetEntity="ControlPanelBundle\Entity\TipoOpcion")
     */
    private $tipoMaterial;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=9, scale=2, options={"default"=0})
     */
    private $cantidad;

    /**
     * @var InventarioMaterial
     * @ORM\OneToMany(targetEntity="InventarioBundle\Entity\InventarioMaterial", mappedBy="material")
     */
    private $inventario;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $fecha;

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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Material
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Material
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
     * Set tipoMaterial
     *
     * @param \ControlPanelBundle\Entity\TipoOpcion $tipoMaterial
     *
     * @return Material
     */
    public function setTipoMaterial(\ControlPanelBundle\Entity\TipoOpcion $tipoMaterial = null)
    {
        $this->tipoMaterial = $tipoMaterial;

        return $this;
    }

    /**
     * Get tipoMaterial
     *
     * @return \ControlPanelBundle\Entity\TipoOpcion
     */
    public function getTipoMaterial()
    {
        return $this->tipoMaterial;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->fecha = new \DateTime();
        $this->cantidad = 0;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Material
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
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return Material
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inventario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add inventario
     *
     * @param \InventarioBundle\Entity\InventarioMaterial $inventario
     *
     * @return Material
     */
    public function addInventario(\InventarioBundle\Entity\InventarioMaterial $inventario)
    {
        $this->inventario[] = $inventario;

        return $this;
    }

    /**
     * Remove inventario
     *
     * @param \InventarioBundle\Entity\InventarioMaterial $inventario
     */
    public function removeInventario(\InventarioBundle\Entity\InventarioMaterial $inventario)
    {
        $this->inventario->removeElement($inventario);
    }

    /**
     * Get inventario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInventario()
    {
        return $this->inventario;
    }
}
