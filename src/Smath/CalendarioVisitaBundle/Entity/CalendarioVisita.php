<?php

namespace Smath\CalendarioVisitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarioVisita
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CalendarioVisita
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
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Empleado",cascade={"persist"})
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    private $empleado;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\PuntoVenta",cascade={"persist"})
     * @ORM\JoinColumn(name="puntoVenta", referencedColumnName="id")
     */
    private $puntoVenta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaProgramada", type="datetime")
     */
    private $fechaProgramada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVisita", type="datetime")
     */
    private $fechaVisita;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\CalendarioVisitaBundle\Entity\TipoVisita",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoVisita", referencedColumnName="id")
     */
    private $tipoVisita;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordenSugerido", type="integer")
     */
    private $ordenSugerido;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordenFinal", type="integer")
     */
    private $ordenFinal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="atendida", type="boolean")
     */
    private $atendida;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reprogramada", type="boolean")
     */
    private $reprogramada;

    /**
     * @ORM\ManyToOne(targetEntity="CalendarioVisita",cascade={"persist"})
     * @ORM\JoinColumn(name="calendarioVisita", referencedColumnName="id")
     */
    private $calendarioVisita;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreQuienAtendio", type="string", length=255)
     */
    private $nombreQuienAtendio;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visitado", type="boolean")
     */
    private $visitado;


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
     * Set fechaProgramada
     *
     * @param \DateTime $fechaProgramada
     * @return CalendarioVisita
     */
    public function setFechaProgramada($fechaProgramada)
    {
        $this->fechaProgramada = $fechaProgramada;

        return $this;
    }

    /**
     * Get fechaProgramada
     *
     * @return \DateTime
     */
    public function getFechaProgramada()
    {
        return $this->fechaProgramada;
    }

    /**
     * Set fechaVisita
     *
     * @param \DateTime $fechaVisita
     * @return CalendarioVisita
     */
    public function setFechaVisita($fechaVisita)
    {
        $this->fechaVisita = $fechaVisita;

        return $this;
    }

    /**
     * Get fechaVisita
     *
     * @return \DateTime
     */
    public function getFechaVisita()
    {
        return $this->fechaVisita;
    }

    /**
     * Set ordenSugerido
     *
     * @param integer $ordenSugerido
     * @return CalendarioVisita
     */
    public function setOrdenSugerido($ordenSugerido)
    {
        $this->ordenSugerido = $ordenSugerido;

        return $this;
    }

    /**
     * Get ordenSugerido
     *
     * @return integer
     */
    public function getOrdenSugerido()
    {
        return $this->ordenSugerido;
    }

    /**
     * Set ordenFinal
     *
     * @param integer $ordenFinal
     * @return CalendarioVisita
     */
    public function setOrdenFinal($ordenFinal)
    {
        $this->ordenFinal = $ordenFinal;

        return $this;
    }

    /**
     * Get ordenFinal
     *
     * @return integer
     */
    public function getOrdenFinal()
    {
        return $this->ordenFinal;
    }

    /**
     * Set atendida
     *
     * @param boolean $atendida
     * @return CalendarioVisita
     */
    public function setAtendida($atendida)
    {
        $this->atendida = $atendida;

        return $this;
    }

    /**
     * Get atendida
     *
     * @return boolean
     */
    public function getAtendida()
    {
        return $this->atendida;
    }

    /**
     * Set reprogramada
     *
     * @param boolean $reprogramada
     * @return CalendarioVisita
     */
    public function setReprogramada($reprogramada)
    {
        $this->reprogramada = $reprogramada;

        return $this;
    }

    /**
     * Get reprogramada
     *
     * @return boolean
     */
    public function getReprogramada()
    {
        return $this->reprogramada;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return CalendarioVisita
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set nombreQuienAtendio
     *
     * @param string $nombreQuienAtendio
     * @return CalendarioVisita
     */
    public function setNombreQuienAtendio($nombreQuienAtendio)
    {
        $this->nombreQuienAtendio = $nombreQuienAtendio;

        return $this;
    }

    /**
     * Get nombreQuienAtendio
     *
     * @return string
     */
    public function getNombreQuienAtendio()
    {
        return $this->nombreQuienAtendio;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return CalendarioVisita
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set visitado
     *
     * @param boolean $visitado
     * @return CalendarioVisita
     */
    public function setVisitado($visitado)
    {
        $this->visitado = $visitado;

        return $this;
    }

    /**
     * Get visitado
     *
     * @return boolean
     */
    public function getVisitado()
    {
        return $this->visitado;
    }

    /**
     * Set empleado
     *
     * @param \Smath\EmpresaBundle\Entity\Empleado $empleado
     * @return CalendarioVisita
     */
    public function setEmpleado(\Smath\EmpresaBundle\Entity\Empleado $empleado = null)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \Smath\EmpresaBundle\Entity\Empleado
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set puntoVenta
     *
     * @param \Smath\ClienteBundle\Entity\PuntoVenta $puntoVenta
     * @return CalendarioVisita
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
     * Set tipoVisita
     *
     * @param \Smath\CalendarioVisitaBundle\Entity\TipoVisita $tipoVisita
     * @return CalendarioVisita
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
     * Set calendarioVisita
     *
     * @param \Smath\CalendarioVisitaBundle\Entity\CalendarioVisita $calendarioVisita
     * @return CalendarioVisita
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
}
