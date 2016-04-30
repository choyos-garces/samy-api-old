<?php
namespace AdministracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Material
 * 
 * @ORM\Entity(repositoryClass="AdministracionBundle\Repository\BodegaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Bodega implements \JsonSerializable
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
     * @ORM\Column(type="string", length=32)
     */
    private $codigo;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $nombre;
    
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Bodega
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
     * @return Bodega
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Bodega
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
     * @return Bodega
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

    function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "codigo" => $this->codigo,
            "nombre" => $this->nombre,
            "fecha" => $this->fecha
        ];
    }


}
