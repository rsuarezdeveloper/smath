<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * proveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\proveedorRepository")
 */
class proveedor
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
     * @ORM\Column(name="pro_razonsocial", type="string", length=150)
     */
    private $proRazonsocial;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipodocumento_id", type="integer")
     */
    private $tipodocumentoId;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_numerodocumento", type="string", length=100)
     */
    private $proNumerodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_direccion", type="string", length=45)
     */
    private $proDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_telefono", type="string", length=45)
     */
    private $proTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_correoelectronico", type="string", length=100)
     */
    private $proCorreoelectronico;

    /**
     * @var integer
     *
     * @ORM\Column(name="pro_activo", type="integer")
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
     * Set proRazonsocial
     *
     * @param string $proRazonsocial
     * @return proveedor
     */
    public function setProRazonsocial($proRazonsocial)
    {
        $this->proRazonsocial = $proRazonsocial;

        return $this;
    }

    /**
     * Get proRazonsocial
     *
     * @return string
     */
    public function getProRazonsocial()
    {
        return $this->proRazonsocial;
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
     * Set proNumerodocumento
     *
     * @param string $proNumerodocumento
     * @return proveedor
     */
    public function setProNumerodocumento($proNumerodocumento)
    {
        $this->proNumerodocumento = $proNumerodocumento;

        return $this;
    }

    /**
     * Get proNumerodocumento
     *
     * @return string
     */
    public function getProNumerodocumento()
    {
        return $this->proNumerodocumento;
    }

    /**
     * Set proDireccion
     *
     * @param string $proDireccion
     * @return proveedor
     */
    public function setProDireccion($proDireccion)
    {
        $this->proDireccion = $proDireccion;

        return $this;
    }

    /**
     * Get proDireccion
     *
     * @return string
     */
    public function getProDireccion()
    {
        return $this->proDireccion;
    }

    /**
     * Set proTelefono
     *
     * @param string $proTelefono
     * @return proveedor
     */
    public function setProTelefono($proTelefono)
    {
        $this->proTelefono = $proTelefono;

        return $this;
    }

    /**
     * Get proTelefono
     *
     * @return string
     */
    public function getProTelefono()
    {
        return $this->proTelefono;
    }

    /**
     * Set proCorreoelectronico
     *
     * @param string $proCorreoelectronico
     * @return proveedor
     */
    public function setProCorreoelectronico($proCorreoelectronico)
    {
        $this->proCorreoelectronico = $proCorreoelectronico;

        return $this;
    }

    /**
     * Get proCorreoelectronico
     *
     * @return string
     */
    public function getProCorreoelectronico()
    {
        return $this->proCorreoelectronico;
    }

    /**
     * Set proActivo
     *
     * @param integer $proActivo
     * @return proveedor
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
}
