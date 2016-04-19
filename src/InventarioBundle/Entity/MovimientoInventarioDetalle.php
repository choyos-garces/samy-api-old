<?php

namespace InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovimientoInventarioDetalle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\MovimientoInventarioDetalleRepository")
 */
class MovimientoInventarioDetalle
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
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Empresa")
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id", nullable=true)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $factura;

    /**
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Plantacion")
     * @ORM\JoinColumn(name="plantacion_id", referencedColumnName="id", nullable=true)
     */
    private $plantacion;

    /**
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Bodega")
     * @ORM\JoinColumn(name="bodega_id", referencedColumnName="id", nullable=true)
     */
    private $bodega;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $confirmacion;
    
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
     * Set factura
     *
     * @param string $factura
     *
     * @return MovimientoInventarioDetalle
     */
    public function setFactura($factura)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return string
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set proveedor
     *
     * @param \AdministracionBundle\Entity\Empresa $proveedor
     *
     * @return MovimientoInventarioDetalle
     */
    public function setProveedor(\AdministracionBundle\Entity\Empresa $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \AdministracionBundle\Entity\Empresa
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set plantacion
     *
     * @param \AdministracionBundle\Entity\Plantacion $plantacion
     *
     * @return MovimientoInventarioDetalle
     */
    public function setPlantacion(\AdministracionBundle\Entity\Plantacion $plantacion = null)
    {
        $this->plantacion = $plantacion;

        return $this;
    }

    /**
     * Get plantacion
     *
     * @return \AdministracionBundle\Entity\Plantacion
     */
    public function getPlantacion()
    {
        return $this->plantacion;
    }

    /**
     * Set bodega
     *
     * @param \AdministracionBundle\Entity\Bodega $bodega
     *
     * @return MovimientoInventarioDetalle
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
     * Set confirmacion
     *
     * @param string $confirmacion
     *
     * @return MovimientoInventarioDetalle
     */
    public function setConfirmacion($confirmacion)
    {
        $this->confirmacion = $confirmacion;

        return $this;
    }

    /**
     * Get confirmacion
     *
     * @return string
     */
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }
}
