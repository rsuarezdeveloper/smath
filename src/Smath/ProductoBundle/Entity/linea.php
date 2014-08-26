<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * linea
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\lineaRepository")
 */
class linea
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
     * @ORM\Column(name="lin_lin_id", type="integer")
     */
    private $linLinId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lin_codigo", type="integer")
     */
    private $linCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="lin_descripcion", type="string", length=45)
     */
    private $linDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="linea_id", type="integer")
     */
    private $lineaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lin_activo", type="smallint")
     */
    private $linActivo;


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
     * Set linLinId
     *
     * @param integer $linLinId
     * @return linea
     */
    public function setLinLinId($linLinId)
    {
        $this->linLinId = $linLinId;

        return $this;
    }

    /**
     * Get linLinId
     *
     * @return integer
     */
    public function getLinLinId()
    {
        return $this->linLinId;
    }

    /**
     * Set linCodigo
     *
     * @param integer $linCodigo
     * @return linea
     */
    public function setLinCodigo($linCodigo)
    {
        $this->linCodigo = $linCodigo;

        return $this;
    }

    /**
     * Get linCodigo
     *
     * @return integer
     */
    public function getLinCodigo()
    {
        return $this->linCodigo;
    }

    /**
     * Set linDescripcion
     *
     * @param string $linDescripcion
     * @return linea
     */
    public function setLinDescripcion($linDescripcion)
    {
        $this->linDescripcion = $linDescripcion;

        return $this;
    }

    /**
     * Get linDescripcion
     *
     * @return string
     */
    public function getLinDescripcion()
    {
        return $this->linDescripcion;
    }

    /**
     * Set lineaId
     *
     * @param integer $lineaId
     * @return linea
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

    /**
     * Set linActivo
     *
     * @param integer $linActivo
     * @return linea
     */
    public function setLinActivo($linActivo)
    {
        $this->linActivo = $linActivo;

        return $this;
    }

    /**
     * Get linActivo
     *
     * @return integer
     */
    public function getLinActivo()
    {
        return $this->linActivo;
    }

    public function __toString()
    {
        return $this->linDescripcion;
    }
}
