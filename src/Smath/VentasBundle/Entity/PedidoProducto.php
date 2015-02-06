<?php

namespace Smath\VentasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoProducto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PedidoProducto
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
     * @ORM\ManyToOne(targetEntity="Smath\VentasBundle\Entity\Pedido",cascade={"persist"})
     * @ORM\JoinColumn(name="pedido", referencedColumnName="id")
     */
    private $pedido;

    /**
     * @ORM\ManyToOne(targetEntity="Smath\ProductoBundle\Entity\Producto",cascade={"persist"})
     * @ORM\JoinColumn(name="producto", referencedColumnName="id")
     */
    private $producto;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="float")
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="valorUnidad", type="float")
     */
    private $valorUnidad;

    /**
     * @var float
     *
     * @ORM\Column(name="valorTotal", type="float")
     */
    private $valorTotal;

    /**
     * @var text
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;


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
     * Set pedido
     *
     * @param integer $pedido
     * @return PedidoProducto
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return integer 
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set producto
     *
     * @param integer $producto
     * @return PedidoProducto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return integer 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return PedidoProducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set valorTotal
     *
     * @param float $valorUnidad
     * @return PedidoProducto
     */
    public function setValorUnidad($valorUnidad)
    {
        $this->valorUnidad = $valorUnidad;

        return $this;
    }

    /**
     * Get valorUnidad
     *
     * @return float 
     */
    public function getValorUnidad()
    {
        return $this->valorUnidad;
    }

    /**
     * Set valorTotal
     *
     * @param float $valorTotal
     * @return PedidoProducto
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return float 
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return PedidoProducto
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     *
     * @return string
     */
    public function __toString()             
    {
        return $this->nombre;
    }
}
