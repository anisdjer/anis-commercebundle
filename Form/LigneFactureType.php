<?php

namespace Anis\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneFactureType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('unityPrice')
            ->add('discount')
            ->add('product')
            ->add('facture')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Anis\CommerceBundle\Entity\LigneFacture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anis_commercebundle_lignefacture';
    }
}
