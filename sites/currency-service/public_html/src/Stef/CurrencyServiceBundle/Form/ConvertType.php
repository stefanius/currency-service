<?php

namespace Stef\CurrencyServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;

class ConvertType extends AbstractType
{
    protected $choices = [];

    /**
     * @param array $choices
     */
    function __construct($choices)
    {
        $this->choices = $choices;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'choice', [
                'choices' => $this->choices,
                'label' => 'From',
            ])
            ->add('to', 'choice', [
                'choices' => $this->choices,
                'label' => 'To',
            ])
            ->add('amount', 'text', [
                'label' => 'Amount',
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection([]);

        $resolver->setDefaults([
            'constraints' => $collectionConstraint
        ]);
    }

    public function getName()
    {
        return 'converter';
    }
}