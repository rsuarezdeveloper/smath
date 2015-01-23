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
    private $Codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=45)
     */
    private $Descripcion;

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
     * Set Codigo
     *
     * @param integer $Codigo
     * @return linea
     */
    public function setCodigo($Codigo)
    {
        $this->Codigo = $Codigo;

        return $this;
    }

    /**
     * Get Codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->Codigo;
    }

    /**
     * Set Descripcion
     *
     * @param string $Descripcion
     * @return linea
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
     * @param integer $estado
     * @return linea
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

    public function __toString()
    {
        return $this->Descripcion;
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
