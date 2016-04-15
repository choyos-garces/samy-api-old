<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/31/2016
 * Time: 2:17 PM
 */

namespace InventarioBundle\Entity;

use AdministracionBundle\Entity\Bodega;
use AdministracionBundle\Entity\Material;
use Doctrine\ORM\Mapping as ORM;

/**
 * Inventario Material
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="InventarioBundle\Repository\InventarioMaterialRepository")
 * @ORM\HasLifecycleCallbacks
 */
class InventarioMaterial implements \JsonSerializable
{
    /**
     * @var integer $id Index
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Material $material Material/Bodega
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Material")
     */
    private $material;

    /**
     * @var Bodega $bodega
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Bodega")
     */
    private $bodega;

    /**
     * @var string $cantidad No puede ser menos de 0
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $cantidad;

    /**
     * @var \DateTime Actualiza cada vez que se actualiza
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->fecha = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() {
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
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return InventarioMaterial
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return InventarioMaterial
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
     * Set material
     *
     * @param \AdministracionBundle\Entity\Material $material
     *
     * @return InventarioMaterial
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
     * @return InventarioMaterial
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

    function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "cantidad" => $this->cantidad,
            "material" => $this->getMaterial(),
            "bodega" => $this->getBodega(),
            "fecha" => $this->fecha->format(\DateTime::ISO8601)
        ];
    }

}
