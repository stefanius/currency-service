<?php

namespace Stef\CurrencyServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;

class ConvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'choice', [
                'choices' => [
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                ],
                'label' => 'From',
            ])
            ->add('to', 'choice', [
                'choices' => [
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                ],
                'label' => 'To',
            ])
            ->add('amount', 'text', [
                'label' => 'Amount',
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(

        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'converter';
    }
}