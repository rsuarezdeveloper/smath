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
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

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
     * Set telefono
     *
     * @param string $telefono
     * @return PuntoVenta
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
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
}
