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
    private $Referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45)
     */
    private $Nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150)
     */
    private $Descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="smallint")
     */
    private $Estado;


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
    public function setReferencia($Referencia)
    {
        $this->Referencia = $Referencia;

        return $this;
    }

    /**
     * Get Referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->Referencia;
    }

    /**
     * Set Nombre
     *
     * @param string $Nombre
     * @return producto
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set Descripcion
     *
     * @param string $Descripcion
     * @return producto
     */
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    /**
     * Get Descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * Set Estado
     *
     * @param integer Estado
     * @return producto
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;

        return $this;
    }

    /**
     * Get Estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->Estado;
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
         return $this->Nombre;
    }
}
