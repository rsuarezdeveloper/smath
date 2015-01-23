<?php

namespace Smath\ClienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PuntoVentaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('numerodocumento')
            ->add('direccion')
            ->add('telefono1')
            ->add('correoelectronico')
            ->add('latitud')
            ->add('longitud')
            ->add('cliente')
            ->add('geoUbicacion')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\ClienteBundle\Entity\PuntoVenta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_clientebundle_puntoventa';
    }
}
