<?php

namespace Smath\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpleadoCliente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EmpleadoCliente
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
     * @ORM\ManyToOne(targetEntity="Smath\ClienteBundle\Entity\PuntoVenta",cascade={"persist"})
     * @ORM\JoinColumn(name="puntoventa", referencedColumnName="id")
     */
    private $puntoVenta;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Empleado",cascade={"persist"})
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    private $empleado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAsignacion", type="datetime")
     */
    private $fechaAsignacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="metaVisitasMes", type="integer")
     */
    private $metaVisitasMes;

    /**
     * @var integer
     *
     * @ORM\Column(name="metaVentasMes", type="integer")
     */
    private $metaVentasMes;


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
     * Set fechaAsignacion
     *
     * @param \DateTime $fechaAsignacion
     * @return EmpleadoCliente
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        $this->fechaAsignacion = $fechaAsignacion;

        return $this;
    }

    /**
     * Get fechaAsignacion
     *
     * @return \DateTime
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return EmpleadoCliente
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
     * Set metaVisitasMes
     *
     * @param integer $metaVisitasMes
     * @return EmpleadoCliente
     */
    public function setMetaVisitasMes($metaVisitasMes)
    {
        $this->metaVisitasMes = $metaVisitasMes;

        return $this;
    }

    /**
     * Get metaVisitasMes
     *
     * @return integer
     */
    public function getMetaVisitasMes()
    {
        return $this->metaVisitasMes;
    }

    /**
     * Set metaVentasMes
     *
     * @param integer $metaVentasMes
     * @return EmpleadoCliente
     */
    public function setMetaVentasMes($metaVentasMes)
    {
        $this->metaVentasMes = $metaVentasMes;

        return $this;
    }

    /**
     * Get metaVentasMes
     *
     * @return integer
     */
    public function getMetaVentasMes()
    {
        return $this->metaVentasMes;
    }

    /**
     * Set cliente
     *
     * @param \Smath\ClienteBundle\Entity\Cliente $cliente
     * @return EmpleadoCliente
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
     * Set puntoVenta
     *
     * @param \Smath\ClienteBundle\Entity\PuntoVenta $puntoVenta
     * @return EmpleadoCliente
     */
    public function setPuntoVenta(\Smath\ClienteBundle\Entity\PuntoVenta $puntoVenta = null)
    {
        $this->puntoVenta = $puntoVenta;

        return $this;
    }

    /**
     * Get puntoVenta
     *
     * @return \Smath\ClienteBundle\Entity\PuntoVenta
     */
    public function getPuntoVenta()
    {
        return $this->puntoVenta;
    }

    /**
     * Set empleado
     *
     * @param \Smath\EmpresaBundle\Entity\Empleado $empleado
     * @return EmpleadoCliente
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
