<?php

namespace Smath\ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoProveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smath\ProductoBundle\Entity\ProductoProveedorRepository")
 */
class ProductoProveedor
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
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\Producto",cascade={"persist"})
     * @ORM\JoinColumn(name="producto", referencedColumnName="id")
     */
    private $producto;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\Proveedor",cascade={"persist"})
     * @ORM\JoinColumn(name="proveedor", referencedColumnName="id")
     */
    private $proveedor;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $Stock;


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
     * Set Stock
     *
     * @param integer $Stock
     * @return productoproveedor
     */
    public function setStock($Stock)
    {
        $this->proproStock = $Stock;

        return $this;
    }

    /**
     * Get Stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->Stock;
    }

    /**
     * Set producto
     *
     * @param \Smath\ProductoBundle\Entity\Producto $producto
     * @return productoproveedor
     */
    public function setProducto(\Smath\ProductoBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \Smath\ProductoBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set proveedor
     *
     * @param \Smath\ProductoBundle\Entity\Proveedor $proveedor
     * @return productoproveedor
     */
    public function setProveedor(\Smath\ProductoBundle\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Smath\ProductoBundle\Entity\Proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
}
