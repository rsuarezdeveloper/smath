<?php

namespace Smath\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pedido')
            ->add('producto')
            ->add('cantidad')
            ->add('observaciones')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\VentasBundle\Entity\PedidoProducto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_ventasbundle_pedidoproducto';
    }
}
