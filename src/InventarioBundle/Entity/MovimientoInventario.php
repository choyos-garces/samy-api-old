<?php

namespace InventarioBundle\Entity;

use AdministracionBundle\Entity\Bodega;
use ControlPanelBundle\Entity\MotivoMovimientoInventario;
use Doctrine\ORM\Mapping as ORM;

/**
 * MovimientoInventario
 *
 * @ORM\Table(name="movimiento_inventario")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\MovimientoInventarioRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MovimientoInventario implements \JsonSerializable
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
     * @var int
     *
     * @ORM\Column(name="tipoMovimiento", type="integer")
     */
    private $tipoMovimiento;

    /**
     * @var Bodega
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Bodega")
     */
    private $bodega;

    /**
     * @var MotivoMovimientoInventario
     * @ORM\ManyToOne(targetEntity="ControlPanelBundle\Entity\MotivoMovimientoInventario")
     */
    private $motivoMovimiento;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection()
     * @ORM\OneToMany(targetEntity="InventarioBundle\Entity\MovimientoMaterial", mappedBy="movimientoInventario", cascade={"persist"})
     */
    private $movimientosMateriales;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipoMovimiento
     *
     * @param integer $tipoMovimiento
     *
     * @return MovimientoInventario
     */
    public function setTipoMovimiento($tipoMovimiento)
    {
        $this->tipoMovimiento = $tipoMovimiento;

        return $this;
    }

    /**
     * Get tipoMovimiento
     *
     * @return int
     */
    public function getTipoMovimiento()
    {
        return $this->tipoMovimiento;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return MovimientoInventario
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
        $this->movimientosMateriales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set bodega
     *
     * @param \AdministracionBundle\Entity\Bodega $bodega
     *
     * @return MovimientoInventario
     */
    public function setBodega(\AdministracionBundle\Entity\Bodega $bodega = null)
    {
        $this->bodega = $bodega;

        return $this;
    }

    /**
     * Get bodega
     *
     * @return \AdministracionBundle\Entity\Bodega
     */
    public function getBodega()
    {
        return $this->bodega;
    }

    /**
     * Set motivoMovimiento
     *
     * @param \ControlPanelBundle\Entity\MotivoMovimientoInventario $motivoMovimiento
     *
     * @return MovimientoInventario
     */
    public function setMotivoMovimiento(\ControlPanelBundle\Entity\MotivoMovimientoInventario $motivoMovimiento = null)
    {
        $this->motivoMovimiento = $motivoMovimiento;

        return $this;
    }

    /**
     * Get motivoMovimiento
     *
     * @return \ControlPanelBundle\Entity\MotivoMovimientoInventario
     */
    public function getMotivoMovimiento()
    {
        return $this->motivoMovimiento;
    }

    /**
     * Add movimientosMateriale
     *
     * @param \InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale
     *
     * @return MovimientoInventario
     */
    public function addMovimientoMaterial(\InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale)
    {
        $this->movimientosMateriales[] = $movimientosMateriale;

        return $this;
    }

    /**
     * Remove movimientosMateriale
     *
     * @param \InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale
     */
    public function removeMovimientoMaterial(\InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale)
    {
        $this->movimientosMateriales->removeElement($movimientosMateriale);
    }

    /**
     * @param $movimientosMateriales
     */
    public function setMovimientosMateriales($movimientosMateriales) {
        $this->movimientosMateriales = $movimientosMateriales;    
    }
    
    /**
     * Get movimientosMateriales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovimientosMateriales()
    {
        return $this->movimientosMateriales;
    }

    /**
     * Add movimientosMateriale
     *
     * @param \InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale
     *
     * @return MovimientoInventario
     */
    public function addMovimientosMateriale(\InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale)
    {
        $this->movimientosMateriales[] = $movimientosMateriale;

        return $this;
    }

    /**
     * Remove movimientosMateriale
     *
     * @param \InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale
     */
    public function removeMovimientosMateriale(\InventarioBundle\Entity\MovimientoMaterial $movimientosMateriale)
    {
        $this->movimientosMateriales->removeElement($movimientosMateriale);
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
        ];
    }


}
