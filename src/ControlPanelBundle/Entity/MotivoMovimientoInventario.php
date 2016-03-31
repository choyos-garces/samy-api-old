<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/22/2016
 * Time: 4:13 PM
 */

namespace ControlPanelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Motivo Movimeinto Inventario
 *
 * @ORM\Entity(repositoryClass="ControlPanelBundle\Repository\MotivoMovimientoInventario")
 */
class MotivoMovimientoInventario
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
     * @ORM\Column(name="nombre", type="string", length=64)
     */
    private $nombre;

    /**
     * @var int
     * 
     * @ORM\Column(name="tipo", type="integer", length=1)
     */
    private $tipo;
    

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MotivoMovimientoInventario
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
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return MotivoMovimientoInventario
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
