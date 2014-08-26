<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * productoproveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\productoproveedorRepository")
 */
class productoproveedor
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
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\producto",cascade={"persist"})
     * @ORM\JoinColumn(name="producto", referencedColumnName="id")
     */
    private $producto;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\proveedor",cascade={"persist"})
     * @ORM\JoinColumn(name="proveedor", referencedColumnName="id")
     */
    private $proveedor;

    /**
     * @var integer
     *
     * @ORM\Column(name="propro_stock", type="integer")
     */
    private $proproStock;


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
     * Set proproStock
     *
     * @param integer $proproStock
     * @return productoproveedor
     */
    public function setProproStock($proproStock)
    {
        $this->proproStock = $proproStock;

        return $this;
    }

    /**
     * Get proproStock
     *
     * @return integer
     */
    public function getProproStock()
    {
        return $this->proproStock;
    }

    /**
     * Set producto
     *
     * @param \Smath\ProductoBundle\Entity\producto $producto
     * @return productoproveedor
     */
    public function setProducto(\Smath\ProductoBundle\Entity\producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \Smath\ProductoBundle\Entity\producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set proveedor
     *
     * @param \Smath\ProductoBundle\Entity\proveedor $proveedor
     * @return productoproveedor
     */
    public function setProveedor(\Smath\ProductoBundle\Entity\proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Smath\ProductoBundle\Entity\proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
}
