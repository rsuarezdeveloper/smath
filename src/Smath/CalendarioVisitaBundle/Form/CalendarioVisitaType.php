<?php

namespace Smath\CalendarioVisitaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalendarioVisitaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaProgramada')
            ->add('fechaVisita')
            ->add('ordenSugerido')
            ->add('ordenFinal')
            ->add('atendida')
            ->add('reprogramada')
            ->add('observaciones')
            ->add('nombreQuienAtendio')
            ->add('foto')
            ->add('visitado')
            ->add('empleado')
            ->add('puntoVenta')
            ->add('tipoVisita')
            ->add('calendarioVisita')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smath\CalendarioVisitaBundle\Entity\CalendarioVisita'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smath_calendariovisitabundle_calendariovisita';
    }
}
