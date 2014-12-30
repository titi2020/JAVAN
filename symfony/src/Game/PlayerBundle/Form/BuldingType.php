<?php

namespace Game\PlayerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BuldingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('point')
            ->add('type', 'entity', array(
                'class' => 'GamePlayerBundle:BuldingType',
                'property' => 'name',
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Game\PlayerBundle\Entity\Bulding'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'game_playerbundle_bulding';
    }
}
