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
            ->add('dateFacturation','date', array('data' => new \DateTime(),'widget' => 'single_text'))
            ->add('datePaiement','date', array('data' => new \DateTime(),'widget' => 'single_text'))
            ->add('methodPaiement' ,"choice",  array('choices' => array('cheque' => 'cheque' , 'montant' => 'montant' )))
            ->add('total', NULL, array('data' => 0, "read_only" => true))
            ->add('paid' , NULL, array('data' => false))
            ->add('lines')
            ->add('client')
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
