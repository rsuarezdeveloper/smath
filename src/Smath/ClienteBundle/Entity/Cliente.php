<?php

namespace Smath\ClienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cliente
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
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\Cliente",cascade={"persist"})
     * @ORM\JoinColumn(name="clienteId", referencedColumnName="id", nullable=true)
     */
    private $clienteId;

     /**
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\TipoCliente",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoCliente", referencedColumnName="id")
     */
    private $tipoCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="razonSocial", type="string", length=255)
     */
    private $razonSocial;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\BaseBundle\Entity\TipoDocumento",cascade={"persist"})
     * @ORM\JoinColumn(name="tipoDocumento", referencedColumnName="id")
     */
    private $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDocumento", type="string", length=255)
     */
    private $numeroDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="correoElectronico", type="string", length=255)
     */
    private $correoElectronico;


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
     * Set razonSocial
     *
     * @param string $razonSocial
     * @return Cliente
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }


    /**
     * Set numeroDocumento
     *
     * @param string $numeroDocumento
     * @return Cliente
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Cliente
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
     * Set correoElectronico
     *
     * @param string $correoElectronico
     * @return Cliente
     */
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }

    /**
     * Set clienteId
     *
     * @param \Smath\ClienteBundle\Entity\Cliente $clienteId
     * @return Cliente
     */
    public function setClienteId(\Smath\ClienteBundle\Entity\Cliente $clienteId = null)
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    /**
     * Get clienteId
     *
     * @return \Smath\ClienteBundle\Entity\Cliente
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }

    /**
     * Set tipoCliente
     *
     * @param \Smath\ClienteBundle\Entity\TipoCliente $tipoCliente
     * @return Cliente
     */
    public function setTipoCliente(\Smath\ClienteBundle\Entity\TipoCliente $tipoCliente = null)
    {
        $this->tipoCliente = $tipoCliente;

        return $this;
    }

    /**
     * Get tipoCliente
     *
     * @return \Smath\ClienteBundle\Entity\TipoCliente
     */
    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }



    /**
     * Set tipoDocumento
     *
     * @param \Smath\BaseBundle\Entity\TipoDocumento $tipoDocumento
     * @return Cliente
     */
    public function setTipoDocumento(\Smath\BaseBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \Smath\BaseBundle\Entity\TipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function __toString(){
         return $this->razonSocial;
    }
}
