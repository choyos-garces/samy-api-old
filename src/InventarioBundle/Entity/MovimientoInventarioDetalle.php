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
     * @ORM\OneToMany(targetEntity="AdministracionBundle\Entity\Empresa")
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
     * @ORM\OneToMany(targetEntity="AdministracionBundle\Entity\Plantacion")
     * @ORM\JoinColumn(name="plantacion_id", referencedColumnName="id", nullable=true)
     */
    private $plantacion;

    /**
     * @ORM\OneToMany(targetEntity="AdministracionBundle\Entity\Bodega")
     * @ORM\JoinColumn(name="bodega_id", referencedColumnName="id", nullable=true)
     */
    private $bodega;
}