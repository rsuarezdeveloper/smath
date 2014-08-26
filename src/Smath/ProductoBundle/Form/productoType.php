<?php

namespace Smath\ProductoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class productoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proReferencia')
            ->add('proNombre')
            ->add('proDescripcion')
            ->add('proActivo')
            ->add('linea')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\ProductoBundle\Entity\producto'
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
