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
            ->add('price')
            ->add('name')
            ->add('manufacturer')
            ->add('supplier')
            ->add('discounted')
            ->add('discountValue')
            ->add('dateDiscountEnd')
            ->add('stock')
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
