<?php

namespace Smath\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpleadoClienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaAsignacion')
            ->add('estado')
            ->add('metaVisitasMes')
            ->add('metaVentasMes')
            ->add('cliente')
            ->add('puntoVenta')
            ->add('empleado')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\EmpresaBundle\Entity\EmpleadoCliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_empresabundle_empleadocliente';
    }
}
