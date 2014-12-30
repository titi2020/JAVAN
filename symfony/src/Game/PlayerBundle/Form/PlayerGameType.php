<?php

namespace Game\PlayerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerGameType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('player', 'entity', array(
                'class' => 'GamePlayerBundle:Player',
                'property' => 'username',
            ))

            ->add('game', 'entity', array(
                'class' => 'GamePlayerBundle:Game',
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
            'data_class' => 'Game\PlayerBundle\Entity\PlayerGame'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'game_playerbundle_playergame';
    }
}
