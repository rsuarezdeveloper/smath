<?php

namespace Smath\CalendarioVisitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensaje
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mensaje
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
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Empleado",cascade={"persist"})
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    private $empleado;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Empleado",cascade={"persist"})
     * @ORM\JoinColumn(name="empleadoId", referencedColumnName="id")
     */
    private $empleadoId;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="string", length=255)
     */
    private $mensaje;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="leido", type="boolean")
     */
    private $leido;


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
     * Set mensaje
     *
     * @param string $mensaje
     * @return Mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Mensaje
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set leido
     *
     * @param boolean $leido
     * @return Mensaje
     */
    public function setLeido($leido)
    {
        $this->leido = $leido;

        return $this;
    }

    /**
     * Get leido
     *
     * @return boolean
     */
    public function getLeido()
    {
        return $this->leido;
    }
}
