<?php

namespace Smath\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pedido
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Auth\UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     */
    private $usuario;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\PuntoVenta",cascade={"persist"})
     * @ORM\JoinColumn(name="puntoVenta", referencedColumnName="id")
     */
    private $puntoVenta;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\CalendarioVisitaBundle\Entity\CalendarioVisita",cascade={"persist"})
     * @ORM\JoinColumn(name="calendarioVisita", referencedColumnName="id")
     */
    private $calendarioVisita;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEntrega", type="datetime")
     */
    private $fechaEntrega;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;


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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Pedido
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     * @return Pedido
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return integer 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     * @return Pedido
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set puntoVenta
     *
     * @param \Smath\ClienteBundle\Entity\PuntoVenta $puntoVenta
     * @return Pedido
     */
    public function setPuntoVenta(\Smath\ClienteBundle\Entity\PuntoVenta $puntoVenta = null)
    {
        $this->puntoVenta = $puntoVenta;

        return $this;
    }

    /**
     * Get puntoVenta
     *
     * @return \Smath\ClienteBundle\Entity\PuntoVenta 
     */
    public function getPuntoVenta()
    {
        return $this->puntoVenta;
    }

    /**
     * Set calendarioVisita
     *
     * @param \Smath\CalendarioVisitaBundle\Entity\CalendarioVisita $calendarioVisita
     * @return Pedido
     */
    public function setCalendarioVisita(\Smath\CalendarioVisitaBundle\Entity\CalendarioVisita $calendarioVisita = null)
    {
        $this->calendarioVisita = $calendarioVisita;

        return $this;
    }

    /**
     * Get calendarioVisita
     *
     * @return \Smath\CalendarioVisitaBundle\Entity\CalendarioVisita 
     */
    public function getCalendarioVisita()
    {
        return $this->calendarioVisita;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Pedido
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
     *
     * @return string
     */
    public function __toString() 
    {   
        // hack
        return "$this->id";
    }
}
