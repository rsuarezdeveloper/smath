<?php

namespace Smath\VentasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cliente')
            ->add('puntoVenta')
            ->add('calendarioVisita')
            ->add('fechaEntrega', null, array('widget' => 'single_text', 'attr' => array('class' => 'datePicker'), 'data' => new \DateTime()))
            ->add('estado', null, array('data' => true, 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\VentasBundle\Entity\Pedido'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_ventasbundle_pedido';
    }
}
