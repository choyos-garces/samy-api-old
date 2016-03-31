<?php

namespace ControlPanelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMaterial
 *
 * @ORM\Table(name="tipo_opcion")
 * @ORM\Entity(repositoryClass="ControlPanelBundle\Repository\TipoOpcionRepository")
 */
class TipoOpcion
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
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=64)
     */
    private $grupo;
    
    public function setId($id)
    {
        $this->id = $id;
    }
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoOpciones
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
