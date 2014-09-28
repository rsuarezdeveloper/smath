<?php

namespace Smath\CalendarioVisitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpcionTipoVisita
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OpcionTipoVisita
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\CalendarioVisitaBundle\Entity\TipoVisita",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoVisita", referencedColumnName="id")
     */
    private $tipoVisita;


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
     * @return OpcionTipoVisita
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
     * Set estado
     *
     * @param boolean $estado
     * @return OpcionTipoVisita
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
     * Set tipoVisita
     *
     * @param \Smath\CalendarioVisitaBundle\Entity\TipoVisita $tipoVisita
     * @return OpcionTipoVisita
     */
    public function setTipoVisita(\Smath\CalendarioVisitaBundle\Entity\TipoVisita $tipoVisita = null)
    {
        $this->tipoVisita = $tipoVisita;

        return $this;
    }

    /**
     * Get tipoVisita
     *
     * @return \Smath\CalendarioVisitaBundle\Entity\TipoVisita
     */
    public function getTipoVisita()
    {
        return $this->tipoVisita;
    }
    /**
     *
     * @return string
     */
    public function __toString()
    {
        return "{$this->id}";
    }
}
