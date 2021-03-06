<?php

namespace Smath\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compania
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Compania
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
     * @ORM\ManyToOne(targetEntity="Smath\BaseBundle\Entity\GeoUbicacion",cascade={"persist"})
     * @ORM\JoinColumn(name="geoUbicacion", referencedColumnName="id")
     */
    private $geoUbicacion;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Compania",cascade={"persist"})
     * @ORM\JoinColumn(name="companiaId", referencedColumnName="id")
     */
    private $companiaId;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

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
     * Set codigo
     *
     * @param string $codigo
     * @return Compania
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
     * @return Compania
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
     * Set telefono
     *
     * @param string $telefono
     * @return Compania
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
     * Set estado
     *
     * @param boolean $estado
     * @return Compania
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
     * Set geoUbicacion
     *
     * @param \Smath\BaseBundle\Entity\GeoUbicacion $geoUbicacion
     * @return Compania
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
     * Set companiaId
     *
     * @param \Smath\EmpresaBundle\Entity\Compania $companiaId
     * @return Compania
     */
    public function setCompaniaId(\Smath\EmpresaBundle\Entity\Compania $companiaId = null)
    {
        $this->companiaId = $companiaId;

        return $this;
    }

    /**
     * Get companiaId
     *
     * @return \Smath\EmpresaBundle\Entity\Compania
     */
    public function getCompaniaId()
    {
        return $this->companiaId;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
