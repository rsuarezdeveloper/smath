<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * producto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\productoRepository")
 */
class producto
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
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\linea",cascade={"persist"})
     * @ORM\JoinColumn(name="linea", referencedColumnName="id")
     */
    private $linea;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_referencia", type="string", length=45)
     */
    private $proReferencia;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_nombre", type="string", length=45)
     */
    private $proNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_descripcion", type="string", length=150)
     */
    private $proDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="pro_activo", type="smallint")
     */
    private $proActivo;


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
     * Set proReferencia
     *
     * @param string $proReferencia
     * @return producto
     */
    public function setProReferencia($proReferencia)
    {
        $this->proReferencia = $proReferencia;

        return $this;
    }

    /**
     * Get proReferencia
     *
     * @return string
     */
    public function getProReferencia()
    {
        return $this->proReferencia;
    }

    /**
     * Set proNombre
     *
     * @param string $proNombre
     * @return producto
     */
    public function setProNombre($proNombre)
    {
        $this->proNombre = $proNombre;

        return $this;
    }

    /**
     * Get proNombre
     *
     * @return string
     */
    public function getProNombre()
    {
        return $this->proNombre;
    }

    /**
     * Set proDescripcion
     *
     * @param string $proDescripcion
     * @return producto
     */
    public function setProDescripcion($proDescripcion)
    {
        $this->proDescripcion = $proDescripcion;

        return $this;
    }

    /**
     * Get proDescripcion
     *
     * @return string
     */
    public function getProDescripcion()
    {
        return $this->proDescripcion;
    }

    /**
     * Set proActivo
     *
     * @param integer $proActivo
     * @return producto
     */
    public function setProActivo($proActivo)
    {
        $this->proActivo = $proActivo;

        return $this;
    }

    /**
     * Get proActivo
     *
     * @return integer
     */
    public function getProActivo()
    {
        return $this->proActivo;
    }

    /**
     * Set linea
     *
     * @param \Smath\ProductoBundle\Entity\linea $linea
     * @return producto
     */
    public function setLinea(\Smath\ProductoBundle\Entity\linea $linea = null)
    {
        $this->linea = $linea;

        return $this;
    }

    /**
     * Get linea
     *
     * @return \Smath\ProductoBundle\Entity\linea
     */
    public function getLinea()
    {
        return $this->linea;
    }

    public function __toString()
    {
        return $this->lin_descripcion;
    }
}
