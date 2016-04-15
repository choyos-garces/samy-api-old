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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proveedor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plantacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bodega = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add proveedor
     *
     * @param \AdministracionBundle\Entity\Empresa $proveedor
     *
     * @return MovimientoInventarioDetalle
     */
    public function addProveedor(\AdministracionBundle\Entity\Empresa $proveedor)
    {
        $this->proveedor[] = $proveedor;

        return $this;
    }

    /**
     * Remove proveedor
     *
     * @param \AdministracionBundle\Entity\Empresa $proveedor
     */
    public function removeProveedor(\AdministracionBundle\Entity\Empresa $proveedor)
    {
        $this->proveedor->removeElement($proveedor);
    }

    /**
     * Get proveedor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Add plantacion
     *
     * @param \AdministracionBundle\Entity\Plantacion $plantacion
     *
     * @return MovimientoInventarioDetalle
     */
    public function addPlantacion(\AdministracionBundle\Entity\Plantacion $plantacion)
    {
        $this->plantacion[] = $plantacion;

        return $this;
    }

    /**
     * Remove plantacion
     *
     * @param \AdministracionBundle\Entity\Plantacion $plantacion
     */
    public function removePlantacion(\AdministracionBundle\Entity\Plantacion $plantacion)
    {
        $this->plantacion->removeElement($plantacion);
    }

    /**
     * Get plantacion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlantacion()
    {
        return $this->plantacion;
    }

    /**
     * Add bodega
     *
     * @param \AdministracionBundle\Entity\Bodega $bodega
     *
     * @return MovimientoInventarioDetalle
     */
    public function addBodega(\AdministracionBundle\Entity\Bodega $bodega)
    {
        $this->bodega[] = $bodega;

        return $this;
    }

    /**
     * Remove bodega
     *
     * @param \AdministracionBundle\Entity\Bodega $bodega
     */
    public function removeBodega(\AdministracionBundle\Entity\Bodega $bodega)
    {
        $this->bodega->removeElement($bodega);
    }

    /**
     * Get bodega
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBodega()
    {
        return $this->bodega;
    }
}
