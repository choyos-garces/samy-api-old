<?php

namespace InventarioBundle\Entity;

use AdministracionBundle\Entity\Bodega;
use AdministracionBundle\Entity\Material;
use Doctrine\ORM\Mapping as ORM;

/**
 * MovimientoMaterial
 *
 * @ORM\Table(name="movimiento_material")
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\MovimientoMaterialRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MovimientoMaterial implements \JsonSerializable
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
     * @ORM\Column(name="cantidad", type="decimal", precision=10, scale=2)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $cantidadPrevia;
    
    /**
     * @var int
     *
     * @ORM\Column(name="tipoMovimiento", type="integer")
     */
    private $tipoMovimiento;

    /**
     * @var Material $material
     *
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Material")
     */
    private $material;

    /**
     * @var Bodega $bodega
     *
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Bodega")
     */
    private $bodega;
    
    /**
     * @ORM\ManyToOne(targetEntity="InventarioBundle\Entity\MovimientoInventario", inversedBy="movimientosMateriales", cascade={"persist"})
     */
    private $movimientoInventario;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     *
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
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return MovimientoMaterial
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
     * Set tipoMovimiento
     *
     * @param integer $tipoMovimiento
     *
     * @return MovimientoMaterial
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
     * Set movimientoInventario
     *
     * @param \InventarioBundle\Entity\MovimientoInventario $movimientoInventario
     *
     * @return MovimientoMaterial
     */
    public function setMovimientoInventario(\InventarioBundle\Entity\MovimientoInventario $movimientoInventario = null)
    {
        $this->movimientoInventario = $movimientoInventario;

        return $this;
    }

    /**
     * Get movimientoInventario
     *
     * @return \InventarioBundle\Entity\MovimientoInventario
     */
    public function getMovimientoInventario()
    {
        return $this->movimientoInventario;
    }

    /**
     * Set material
     *
     * @param \AdministracionBundle\Entity\Material $material
     *
     * @return MovimientoMaterial
     */
    public function setMaterial(\AdministracionBundle\Entity\Material $material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return \AdministracionBundle\Entity\Material
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set bodega
     *
     * @param \AdministracionBundle\Entity\Bodega $bodega
     *
     * @return MovimientoMaterial
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
     * Set cantidadPrevia
     *
     * @param string $cantidadPrevia
     *
     * @return MovimientoMaterial
     */
    public function setCantidadPrevia($cantidadPrevia)
    {
        $this->cantidadPrevia = $cantidadPrevia;

        return $this;
    }

    /**
     * Get cantidadPrevia
     *
     * @return string
     */
    public function getCantidadPrevia()
    {
        return $this->cantidadPrevia;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->fecha = new \DateTime();

        $viejoInventario = floatval($this->getMaterial()->getCantidad());
        $cantida = floatval($this->cantidad);

        // 0 es Egreso; 1 es Ingreso
        $nuevoInventario = ($this->tipoMovimiento == 0 ) ? $viejoInventario - $cantida : $viejoInventario + $cantida;

        $this->getMaterial()->setCantidad($nuevoInventario);
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "cantidadPrevia" => $this->cantidadPrevia,
            "cantidad" => $this->cantidad,
            "tipoMovimiento" => $this->tipoMovimiento,
        ];
    }


}
