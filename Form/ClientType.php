<?php

namespace Anis\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
   /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender',"choice",  array('choices' => array("M", "F")))
            ->add('nameTitle',"choice",  array('choices' => array("M." => "M.", "Mme." => "Mme.","Mlle." => "Mlle")))
            ->add('firstname')
            ->add('lastname')
            ->add('emailAddress', 'email')
            ->add('age')
            ->add('enabled', 'checkbox', array('data' => true))
            ->add('registrationDate','date',array('widget' => 'single_text', 'data' => new \DateTime("now")))
            ->add('lastVisit','date', array('widget' => 'single_text'))
            ->add('language',"choice",  array('choices' => array("en" => "English", "fr" => "Français", "it" => "Italien")))
            ->add('cin')
            ->add('tel')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Anis\CommerceBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anis_commercebundle_client';
    }
}
