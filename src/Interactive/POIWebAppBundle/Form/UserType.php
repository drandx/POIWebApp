<?php

namespace Interactive\POIWebAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName','text', array('label' => 'Nombre','attr' => array('placeholder' => 'Nombre')))
            ->add('lastName','text', array('label' => 'Apellido','attr' => array('placeholder' => 'Apellido')))
            ->add('password','password', array('required'=>true,'label' => 'Contraseña *','attr' => array('placeholder' => 'Contraseña')))
            ->add('roles',null, array('expanded'=>false,'required'=>true,'label' => 'Roles *','attr' => array('placeholder' => 'Roles')))
            ->add('email','email', array('required'=>true,'label'=>'Correo electrónico *','attr' => array('placeholder' => 'email')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interactive\POIWebAppBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'interactive_poiwebappbundle_user';
    }
}
