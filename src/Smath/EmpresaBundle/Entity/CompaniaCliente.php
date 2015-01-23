<?php

namespace Smath\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompaniaCliente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CompaniaCliente
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
     * @ORM\JoinColumn(name="cliente", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Compania",cascade={"persist"})
     * @ORM\JoinColumn(name="compania", referencedColumnName="id")
     */
    private $compania;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="date")
     */
    private $fechaIngreso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Empleado",cascade={"persist"})
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    private $empleado;


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
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return CompaniaCliente
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CompaniaCliente
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
     * Set cliente
     *
     * @param \Smath\ClienteBundle\Entity\Cliente $cliente
     * @return CompaniaCliente
     */
    public function setCliente(\Smath\ClienteBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Smath\ClienteBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set compania
     *
     * @param \Smath\EmpresaBundle\Entity\Compania $compania
     * @return CompaniaCliente
     */
    public function setCompania(\Smath\EmpresaBundle\Entity\Compania $compania = null)
    {
        $this->compania = $compania;

        return $this;
    }

    /**
     * Get compania
     *
     * @return \Smath\EmpresaBundle\Entity\Compania
     */
    public function getCompania()
    {
        return $this->compania;
    }

    /**
     * Set empleado
     *
     * @param \Smath\EmpresaBundle\Entity\Empleado $empleado
     * @return CompaniaCliente
     */
    public function setEmpleado(\Smath\EmpresaBundle\Entity\Empleado $empleado = null)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \Smath\EmpresaBundle\Entity\Empleado
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }
}
