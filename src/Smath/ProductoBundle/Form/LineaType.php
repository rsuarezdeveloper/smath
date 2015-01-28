<?php

namespace Smath\ProductoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LineaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('descripcion')
            ->add('lineaId', 'entity', array('class'=>'Smath\ProductoBundle\Entity\Linea'))
            ->add('estado', 'checkbox')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\ProductoBundle\Entity\Linea'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_productobundle_linea';
    }
}
