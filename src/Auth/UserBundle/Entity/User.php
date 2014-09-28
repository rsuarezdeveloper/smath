<?php
// src/Acme/UserBundle/Entity/User.php

namespace Auth\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre="";

    /**
     * @ORM\ManyToOne(targetEntity="Smath\EmpresaBundle\Entity\Empleado",cascade={"persist"})
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    protected $empleado;

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
     * Set nombre
     *
     * @param string $nombre
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set empleado
     *
     * @param \Smath\EmpresaBundle\Entity\Empleado $empleado
     * @return User
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
