<?php

namespace Smath\ProductoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('referencia')
            ->add('nombre')
            ->add('descripcion')
            ->add('estado', null, array('data' => true, 'required' => false))
            ->add('precioUnidadComercial')
            ->add('precioFormaFarmaceutica')
            ->add('linea', 'entity', array('class'=>'Smath\ProductoBundle\Entity\Linea'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\ProductoBundle\Entity\Producto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_productobundle_producto';
    }
}
