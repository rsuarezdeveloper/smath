<?php

namespace Smath\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empleado
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Empleado
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
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\TipoEmpleado",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoEmpleado", referencedColumnName="id")
     */
    private $tipoEmpleado;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Departamento",cascade={"persist"})
     * @ORM\JoinColumn(name="departamento", referencedColumnName="id")
     */
    private $departamento;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\BaseBundle\Entity\GeoUbicacion",cascade={"persist"})
     * @ORM\JoinColumn(name="geoUbicacion", referencedColumnName="id")
     */
    private $geoUbicacion;

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
     * @return Empleado
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
     * @return Empleado
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
     * @return Empleado
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
     * @return Empleado
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
     * Set tipoEmpleado
     *
     * @param \Smath\EmpresaBundle\Entity\TipoEmpleado $tipoEmpleado
     * @return Empleado
     */
    public function setTipoEmpleado(\Smath\EmpresaBundle\Entity\TipoEmpleado $tipoEmpleado = null)
    {
        $this->tipoEmpleado = $tipoEmpleado;

        return $this;
    }

    /**
     * Get tipoEmpleado
     *
     * @return \Smath\EmpresaBundle\Entity\TipoEmpleado
     */
    public function getTipoEmpleado()
    {
        return $this->tipoEmpleado;
    }

    /**
     * Set departamento
     *
     * @param \Smath\EmpresaBundle\Entity\Departamento $departamento
     * @return Empleado
     */
    public function setDepartamento(\Smath\EmpresaBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Smath\EmpresaBundle\Entity\Departamento
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set geoUbicacion
     *
     * @param \Smath\BaseBundle\Entity\GeoUbicacion $geoUbicacion
     * @return Empleado
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
}
