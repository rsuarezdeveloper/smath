<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\ProductoRepository")
 */
class Producto
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
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\Linea",cascade={"persist"})
     * @ORM\JoinColumn(name="Linea", referencedColumnName="id")
     */
    private $linea;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=45)
     */
    private $referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;
    /**
     *@var float
     *
     *@ORM\Column(name="precioUnidadComercial", type="float",nullable=true)
     */
    private $precioUnidadComercial;
    /**
     *@var float
     *
     *@ORM\Column(name="precioFormaFarmaceutica", type="float",nullable=true)
     */
    private $precioFormaFarmaceutica;
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
     * Set Referencia
     *
     * @param string $Referencia
     * @return producto
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get Referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set Nombre
     *
     * @param string $Nombre
     * @return producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set Descripcion
     *
     * @param string $Descripcion
     * @return producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get Descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }



    /**
     * Set linea
     *
     * @param \Smath\ProductoBundle\Entity\Linea $linea
     * @return Producto
     */
    public function setLinea(\Smath\ProductoBundle\Entity\Linea $linea = null)
    {
        $this->linea = $linea;

        return $this;
    }

    /**
     * Get linea
     *
     * @return \Smath\ProductoBundle\Entity\Linea
     */
    public function getLinea()
    {
        return $this->linea;
    }

    public function __toString(){
         return $this->nombre;
    }

    /**
     * Set precioUnidadComercial
     *
     * @param float $precioUnidadComercial
     * @return Producto
     */
    public function setPrecioUnidadComercial($precioUnidadComercial)
    {
        $this->precioUnidadComercial = $precioUnidadComercial;

        return $this;
    }

    /**
     * Get precioUnidadComercial
     *
     * @return float
     */
    public function getPrecioUnidadComercial()
    {
        return $this->precioUnidadComercial;
    }

    /**
     * Set precioFormaFarmaceutica
     *
     * @param float $precioFormaFarmaceutica
     * @return Producto
     */
    public function setPrecioFormaFarmaceutica($precioFormaFarmaceutica)
    {
        $this->precioFormaFarmaceutica = $precioFormaFarmaceutica;

        return $this;
    }

    /**
     * Get precioFormaFarmaceutica
     *
     * @return float
     */
    public function getPrecioFormaFarmaceutica()
    {
        return $this->precioFormaFarmaceutica;
    }

    /**
     * Set Estado
     *
     * @param boolean $estado
     * @return Producto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get Estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
