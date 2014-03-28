<?php

namespace Interactive\POIWebAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Interactive\POIWebAppBundle\Entity\Job;

class PointOfInterestType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('geocity', null, array('required' => true,'label'=>'Ciudad', 'attr' => array('placeholder' => 'Ciudad')))
            ->add('latitude', null, array('required' => true,'label'=>'Latitud', 'attr' => array('placeholder' => 'Latitud')))
            ->add('longitude', null, array('required' => true,'label'=>'Longitud', 'attr' => array('placeholder' => 'Longitud')))
            ->add('description', null, array('required' => false,'label'=>'Descripción', 'attr' => array('placeholder' => 'Descripción')))
            ->add('address', null, array('required' => true,'label'=>'Dirección', 'attr' => array('placeholder' => 'Dirección')))
            ->add('category', null, array('required' => true,'label'=>'Categoría', 'attr' => array('placeholder' => 'Categoría')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interactive\POIWebAppBundle\Entity\PointOfInterest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'interactive_poiwebappbundle_pointofinterest';
    }
}
