<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\ProveedorRepository")
 */
class Proveedor
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
     * @ORM\Column(name="tipoproveedor_id", type="integer")
     */
    private $tipoproveedorId;

    /**
     * @var string
     *
     * @ORM\Column(name="razonsocial", type="string", length=150)
     */
    private $Razonsocial;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipodocumento_id", type="integer")
     */
    private $tipodocumentoId;

    /**
     * @var string
     *
     * @ORM\Column(name="numerodocumento", type="string", length=100)
     */
    private $Numerodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=45)
     */
    private $Direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=45)
     */
    private $Telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="correoelectronico", type="string", length=100)
     */
    private $Correoelectronico;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer")
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
     * Set tipoproveedorId
     *
     * @param integer $tipoproveedorId
     * @return proveedor
     */
    public function setTipoproveedorId($tipoproveedorId)
    {
        $this->tipoproveedorId = $tipoproveedorId;

        return $this;
    }

    /**
     * Get tipoproveedorId
     *
     * @return integer
     */
    public function getTipoproveedorId()
    {
        return $this->tipoproveedorId;
    }

    /**
     * Set Razonsocial
     *
     * @param string $Razonsocial
     * @return proveedor
     */
    public function setRazonsocial($Razonsocial)
    {
        $this->Razonsocial = $Razonsocial;

        return $this;
    }

    /**
     * Get Razonsocial
     *
     * @return string
     */
    public function getRazonsocial()
    {
        return $this->Razonsocial;
    }

    /**
     * Set tipodocumentoId
     *
     * @param integer $tipodocumentoId
     * @return proveedor
     */
    public function setTipodocumentoId($tipodocumentoId)
    {
        $this->tipodocumentoId = $tipodocumentoId;

        return $this;
    }

    /**
     * Get tipodocumentoId
     *
     * @return integer
     */
    public function getTipodocumentoId()
    {
        return $this->tipodocumentoId;
    }

    /**
     * Set Numerodocumento
     *
     * @param string $Numerodocumento
     * @return proveedor
     */
    public function setNumerodocumento($Numerodocumento)
    {
        $this->Numerodocumento = $Numerodocumento;

        return $this;
    }

    /**
     * Get Numerodocumento
     *
     * @return string
     */
    public function getNumerodocumento()
    {
        return $this->Numerodocumento;
    }

    /**
     * Set Direccion
     *
     * @param string $Direccion
     * @return proveedor
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    /**
     * Get Direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * Set Telefono
     *
     * @param string $Telefono
     * @return proveedor
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    /**
     * Get Telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * Set Correoelectronico
     *
     * @param string $Correoelectronico
     * @return proveedor
     */
    public function setCorreoelectronico($Correoelectronico)
    {
        $this->Correoelectronico = $Correoelectronico;

        return $this;
    }

    /**
     * Get Correoelectronico
     *
     * @return string
     */
    public function getCorreoelectronico()
    {
        return $this->Correoelectronico;
    }

    /**
     * Set Estado
     *
     * @param integer $Estado
     * @return proveedor
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
}
