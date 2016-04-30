<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 4/26/2016
 * Time: 5:58 PM
 */

namespace RecursosHumanosBundle\Entity;

use AdministracionBundle\Entity\Bodega;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BodegaPersonal
 * @package RecursosHumanosBundle\Entityz
 * 
 * @ORM\Entity(repositoryClass="RecursosHumanosBundle\Repository\BodegaPersonalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class BodegaPersonal
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Bodega
     * @ORM\ManyToOne(targetEntity="AdministracionBundle\Entity\Bodega")
     */
    private $bodega;

    /**
     * @var Personal
     * @ORM\ManyToOne(targetEntity="RecursosHumanosBundle\Entity\Personal")
     */
    private $personal;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @var /DateTime
     * @ORM\Column(type="date")
     */
    private $desde;

    /**
     * @var /DateTime
     * @ORM\Column(type="date")
     */
    private $hasta;
    

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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return BodegaPersonal
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return BodegaPersonal
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     *
     * @return BodegaPersonal
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set bodega
     *
     * @param \AdministracionBundle\Entity\Bodega $bodega
     *
     * @return BodegaPersonal
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
     * Set personal
     *
     * @param \RecursosHumanosBundle\Entity\Personal $personal
     *
     * @return BodegaPersonal
     */
    public function setPersonal(\RecursosHumanosBundle\Entity\Personal $personal = null)
    {
        $this->personal = $personal;

        return $this;
    }

    /**
     * Get personal
     *
     * @return \RecursosHumanosBundle\Entity\Personal
     */
    public function getPersonal()
    {
        return $this->personal;
    }
}
