<?php

namespace Anis\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFacturation')
            ->add('datePaiement')
            ->add('methodPaiement')
            ->add('total')
            ->add('paid')
            ->add('lines')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Anis\CommerceBundle\Entity\Facture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anis_commercebundle_facture';
    }
}
