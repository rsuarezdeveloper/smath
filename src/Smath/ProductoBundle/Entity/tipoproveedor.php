<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tipoproveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\tipoproveedorRepository")
 */
class tipoproveedor
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
     * @var string
     *
     * @ORM\Column(name="tippro_nombre", type="string", length=45)
     */
    private $tipproNombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tippro_activo", type="smallint")
     */
    private $tipproActivo;


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
     * Set tipproNombre
     *
     * @param string $tipproNombre
     * @return tipoproveedor
     */
    public function setTipproNombre($tipproNombre)
    {
        $this->tipproNombre = $tipproNombre;

        return $this;
    }

    /**
     * Get tipproNombre
     *
     * @return string
     */
    public function getTipproNombre()
    {
        return $this->tipproNombre;
    }

    /**
     * Set tipproActivo
     *
     * @param integer $tipproActivo
     * @return tipoproveedor
     */
    public function setTipproActivo($tipproActivo)
    {
        $this->tipproActivo = $tipproActivo;

        return $this;
    }

    /**
     * Get tipproActivo
     *
     * @return integer
     */
    public function getTipproActivo()
    {
        return $this->tipproActivo;
    }
}
