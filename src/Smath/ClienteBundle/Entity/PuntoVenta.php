<?php

namespace Smath\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PuntoVenta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PuntoVenta
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
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\Cliente",cascade={"persist"})
     * @ORM\JoinColumn(name="cliente", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\BaseBundle\Entity\GeoUbicacion",cascade={"persist"})
     * @ORM\JoinColumn(name="geoUbicacion", referencedColumnName="id")
     */
    private $geoUbicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="numerodocumento", type="integer")
     */
    private $numerodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono1", type="string", length=255)
     */
    private $telefono1;

      /**
     * @var string
     *
     * @ORM\Column(name="telefono2", type="string", length=255)
     */
    private $telefono2;

      /**
     * @var string
     *
     * @ORM\Column(name="telefono3", type="string", length=255)
     */
    private $telefono3;

    /**
     * @var string
     *
     * @ORM\Column(name="correoelectronico", type="string", length=255)
     */
    private $correoelectronico;

    /**
     * @var float
     *
     * @ORM\Column(name="latitud", type="float")
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float")
     */
    private $longitud;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoPunto", type="string", length=255)
     */
    private $codigoPunto;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoZonal", type="string", length=255)
     */
    private $codigoZonal;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreZonal", type="string", length=255)
     */
    private $nombreZonal;

     /**
     * @var integer
     *
     * @ORM\Column(name="estrato", type="integer")
     */
    private $estrato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreAdministrador", type="string", length=255)
     */
    private $nombreAdministrador;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255)
     */
    private $celular;

      /**
     * @var date
     *
     * @ORM\Column(name="fechaApertura", type="date")
     */
    private $fechaApertura;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\TipoServicio",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoServicio", referencedColumnName="id")
     */

    private $tipoServicio;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\TipoHorario",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoHorarioNormal", referencedColumnName="id")
     */
    private $tipoHorarioNormal;

     /**
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\TipoHorario",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoHorarioDominical", referencedColumnName="id")
     */
    private $tipoHorarioDominical;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\FormatoPuntoVenta",cascade={"persist"})
     * @ORM\JoinColumn(name="formatoPuntoVenta", referencedColumnName="id")
     */
    private $formatoPuntoVenta;


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
     * Set nombre
     *
     * @param string $nombre
     * @return PuntoVenta
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
     * Set numerodocumento
     *
     * @param integer $numerodocumento
     * @return PuntoVenta
     */
    public function setNumerodocumento($numerodocumento)
    {
        $this->numerodocumento = $numerodocumento;

        return $this;
    }

    /**
     * Get numerodocumento
     *
     * @return integer
     */
    public function getNumerodocumento()
    {
        return $this->numerodocumento;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return PuntoVenta
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }



    /**
     * Set correoelectronico
     *
     * @param string $correoelectronico
     * @return PuntoVenta
     */
    public function setCorreoelectronico($correoelectronico)
    {
        $this->correoelectronico = $correoelectronico;

        return $this;
    }

    /**
     * Get correoelectronico
     *
     * @return string
     */
    public function getCorreoelectronico()
    {
        return $this->correoelectronico;
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     * @return PuntoVenta
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     * @return PuntoVenta
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set cliente
     *
     * @param \Smath\ClienteBundle\Entity\Cliente $cliente
     * @return PuntoVenta
     */
    public function setCliente(\Smath\ClienteBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Smath\ClienteBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set geoUbicacion
     *
     * @param \Smath\BaseBundle\Entity\GeoUbicacion $geoUbicacion
     * @return PuntoVenta
     */
    public function setGeoUbicacion(\Smath\BaseBundle\Entity\GeoUbicacion $geoUbicacion = null)
    {
        $this->geoUbicacion = $geoUbicacion;

        return $this;
    }

    /**
     * Get geoUbicacion
     *
     * @return \Smath\BaseBundle\Entity\GeoUbicacion
     */
    public function getGeoUbicacion()
    {
        return $this->geoUbicacion;
    }

    /**
     * Set telefono1
     *
     * @param string $telefono1
     * @return PuntoVenta
     */
    public function setTelefono1($telefono1)
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    /**
     * Get telefono1
     *
     * @return string
     */
    public function getTelefono1()
    {
        return $this->telefono1;
    }

    /**
     * Set telefono2
     *
     * @param string $telefono2
     * @return PuntoVenta
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    /**
     * Get telefono2
     *
     * @return string
     */
    public function getTelefono2()
    {
        return $this->telefono2;
    }

    /**
     * Set telefono3
     *
     * @param string $telefono3
     * @return PuntoVenta
     */
    public function setTelefono3($telefono3)
    {
        $this->telefono3 = $telefono3;

        return $this;
    }

    /**
     * Get telefono3
     *
     * @return string
     */
    public function getTelefono3()
    {
        return $this->telefono3;
    }

    /**
     * Set codigoPunto
     *
     * @param string $codigoPunto
     * @return PuntoVenta
     */
    public function setCodigoPunto($codigoPunto)
    {
        $this->codigoPunto = $codigoPunto;

        return $this;
    }

    /**
     * Get codigoPunto
     *
     * @return string
     */
    public function getCodigoPunto()
    {
        return $this->codigoPunto;
    }

    /**
     * Set codigoZonal
     *
     * @param string $codigoZonal
     * @return PuntoVenta
     */
    public function setCodigoZonal($codigoZonal)
    {
        $this->codigoZonal = $codigoZonal;

        return $this;
    }

    /**
     * Get codigoZonal
     *
     * @return string
     */
    public function getCodigoZonal()
    {
        return $this->codigoZonal;
    }

    /**
     * Set nombreZonal
     *
     * @param string $nombreZonal
     * @return PuntoVenta
     */
    public function setNombreZonal($nombreZonal)
    {
        $this->nombreZonal = $nombreZonal;

        return $this;
    }

    /**
     * Get nombreZonal
     *
     * @return string
     */
    public function getNombreZonal()
    {
        return $this->nombreZonal;
    }

    /**
     * Set estrato
     *
     * @param integer $estrato
     * @return PuntoVenta
     */
    public function setEstrato($estrato)
    {
        $this->estrato = $estrato;

        return $this;
    }

    /**
     * Get estrato
     *
     * @return integer
     */
    public function getEstrato()
    {
        return $this->estrato;
    }

    /**
     * Set nombreAdministrador
     *
     * @param string $nombreAdministrador
     * @return PuntoVenta
     */
    public function setNombreAdministrador($nombreAdministrador)
    {
        $this->nombreAdministrador = $nombreAdministrador;

        return $this;
    }

    /**
     * Get nombreAdministrador
     *
     * @return string
     */
    public function getNombreAdministrador()
    {
        return $this->nombreAdministrador;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return PuntoVenta
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set fechaApertura
     *
     * @param \DateTime $fechaApertura
     * @return PuntoVenta
     */
    public function setFechaApertura($fechaApertura)
    {
        $this->fechaApertura = $fechaApertura;

        return $this;
    }

    /**
     * Get fechaApertura
     *
     * @return \DateTime
     */
    public function getFechaApertura()
    {
        return $this->fechaApertura;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return PuntoVenta
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
     * Set tipoServicio
     *
     * @param \Smath\ClienteBundle\Entity\TipoServicio $tipoServicio
     * @return PuntoVenta
     */
    public function setTipoServicio(\Smath\ClienteBundle\Entity\TipoServicio $tipoServicio = null)
    {
        $this->tipoServicio = $tipoServicio;

        return $this;
    }

    /**
     * Get tipoServicio
     *
     * @return \Smath\ClienteBundle\Entity\TipoServicio
     */
    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    /**
     * Set tipoHorarioNormal
     *
     * @param \Smath\ClienteBundle\Entity\TipoHorario $tipoHorarioNormal
     * @return PuntoVenta
     */
    public function setTipoHorarioNormal(\Smath\ClienteBundle\Entity\TipoHorario $tipoHorarioNormal = null)
    {
        $this->tipoHorarioNormal = $tipoHorarioNormal;

        return $this;
    }

    /**
     * Get tipoHorarioNormal
     *
     * @return \Smath\ClienteBundle\Entity\TipoHorario
     */
    public function getTipoHorarioNormal()
    {
        return $this->tipoHorarioNormal;
    }

    /**
     * Set tipoHorarioDominical
     *
     * @param \Smath\ClienteBundle\Entity\TipoHorario $tipoHorarioDominical
     * @return PuntoVenta
     */
    public function setTipoHorarioDominical(\Smath\ClienteBundle\Entity\TipoHorario $tipoHorarioDominical = null)
    {
        $this->tipoHorarioDominical = $tipoHorarioDominical;

        return $this;
    }

    /**
     * Get tipoHorarioDominical
     *
     * @return \Smath\ClienteBundle\Entity\TipoHorario
     */
    public function getTipoHorarioDominical()
    {
        return $this->tipoHorarioDominical;
    }

    /**
     * Set formatoPuntoVenta
     *
     * @param \Smath\ClienteBundle\Entity\FormatoPuntoVenta $formatoPuntoVenta
     * @return PuntoVenta
     */
    public function setFormatoPuntoVenta(\Smath\ClienteBundle\Entity\FormatoPuntoVenta $formatoPuntoVenta = null)
    {
        $this->formatoPuntoVenta = $formatoPuntoVenta;

        return $this;
    }

    /**
     * Get formatoPuntoVenta
     *
     * @return \Smath\ClienteBundle\Entity\FormatoPuntoVenta
     */
    public function getFormatoPuntoVenta()
    {
        return $this->formatoPuntoVenta;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
