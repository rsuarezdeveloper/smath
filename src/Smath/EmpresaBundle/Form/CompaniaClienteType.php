<?php

namespace Smath\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompaniaClienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaIngreso')
            ->add('estado')
            ->add('cliente')
            ->add('compania')
            ->add('empleado')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\EmpresaBundle\Entity\CompaniaCliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_empresabundle_companiacliente';
    }
}
