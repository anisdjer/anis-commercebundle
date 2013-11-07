<?php

namespace Anis\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('price', NULL, array('data' => isset($options['data']) ? $options['data']->getPrice() : 0 ))
            ->add('name')
            ->add('manufacturer')
            ->add('supplier')
            ->add('discountValue', NULL, array('data' => isset($options['data']) ? $options['data']->getDiscountValue() : 0 ))
            ->add('dateDiscountEnd' ,'date', array('widget' => 'single_text', 'data' => isset($options['data']) ? $options['data']->getDateDiscountEnd() : new \DateTime()))
            ->add('stock', NULL, array('data' => isset($options['data']) ? $options['data']->getStock() : 0 ))
            ->add('category')
            ->add('photo','file', array( 'data_class' => null, 'required' => false) )
            ->add('path')
            ->add('description')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Anis\CommerceBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anis_commercebundle_produit';
    }
}
