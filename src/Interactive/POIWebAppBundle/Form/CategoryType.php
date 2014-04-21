<?php

namespace Interactive\POIWebAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, array('required' => true,'label'=>'Nombre *', 'attr' => array('placeholder' => 'Nombre')))
            ->add('pinhexcolor',null, array('required' => true,'label'=>'Color *', 'attr' => array('placeholder' => 'Color')))
            ->add('description',null, array('required' => true,'label'=>'Descripción', 'attr' => array('placeholder' => 'Descripción')))
           ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interactive\POIWebAppBundle\Entity\Category'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'interactive_poiwebappbundle_category';
    }
}
