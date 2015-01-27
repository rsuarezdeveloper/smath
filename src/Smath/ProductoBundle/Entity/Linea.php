<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Linea
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\LineaRepository")
 */
class Linea
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
     * @var integer
     *
     * @ORM\Column(name="codigo", type="integer")
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=45)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="linea_id", type="integer")
     */
    private $lineaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="smallint")
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
     * Set Codigo
     *
     * @param integer $Codigo
     * @return linea
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get Codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set Descripcion
     *
     * @param string $Descripcion
     * @return linea
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
     * Set Estado
     *
     * @param integer $estado
     * @return linea
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get Estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    public function __toString()
    {
        return $this->descripcion;
    }



    /**
     * Set lineaId
     *
     * @param integer $lineaId
     * @return Linea
     */
    public function setLineaId($lineaId)
    {
        $this->lineaId = $lineaId;

        return $this;
    }

    /**
     * Get lineaId
     *
     * @return integer
     */
    public function getLineaId()
    {
        return $this->lineaId;
    }
}
