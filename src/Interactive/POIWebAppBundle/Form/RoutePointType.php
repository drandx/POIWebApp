<?php

namespace Interactive\POIWebAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoutePointType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('latitude')
            ->add('longitude')
            ->add('description')
            ->add('created_at')
            ->add('updated_at')
            ->add('route')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interactive\POIWebAppBundle\Entity\RoutePoint'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'interactive_poiwebappbundle_routepoint';
    }
}
