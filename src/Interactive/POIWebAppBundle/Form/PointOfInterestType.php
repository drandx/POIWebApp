<?php

namespace Interactive\POIWebAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PointOfInterestType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('required' => true,'label'=>'Nombre *', 'attr' => array('placeholder' => 'Nombre')))    
            //->add('email', 'email', array('required' => false,'label'=>'Correo eléctronico', 'attr' => array('placeholder' => 'Correo eléctronico')))
            //->add('phone', null, array('required' => false,'label'=>'Teléfono', 'attr' => array('placeholder' => 'Telefono')))
            //->add('phone_ext', null, array('required' => false,'label'=>'Extensión', 'attr' => array('placeholder' => 'Extensión'))) 
            //->add('fax', null, array('required' => false,'label'=>'Fax', 'attr' => array('placeholder' => 'Fax'))) 
            ->add('geocity', null, array('required' => true,'label'=>'Ciudad *', 'attr' => array('placeholder' => 'Ciudad')))
            ->add('latitude', null, array('required' => true,'label'=>'Latitud *', 'attr' => array('placeholder' => 'Latitud')))
            ->add('longitude', null, array('required' => true,'label'=>'Longitud *', 'attr' => array('placeholder' => 'Longitud')))
            //->add('schedule', null, array('required' => false,'label'=>'Horario', 'attr' => array('placeholder' => 'Horario de atención')))
            ->add('description', null, array('required' => false,'label'=>'Descripción', 'attr' => array('placeholder' => 'Descripción')))
            ->add('address', null, array('required' => true,'label'=>'Dirección *', 'attr' => array('placeholder' => 'Dirección')))
            ->add('category', null, array('required' => true,'label'=>'Categoría *', 'attr' => array('placeholder' => 'Categoría')))
            ->add('route', null, array('required' => true,'label'=>'Ruta *', 'attr' => array('placeholder' => 'Ruta')))
            ->add('near_route_point', null, array('required' => false,'label'=>'Punto de ruta cercano', 'attr' => array('placeholder' => 'Punto Cercano')))
            ->add('submit', 'submit', array('label' => 'Crear Punto'));
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
