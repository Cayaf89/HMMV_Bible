<?php

namespace App\Form;

use App\Entity\Creature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('attaque')
            ->add('defense')
            ->add('puissanceMagique')
            ->add('esprit')
            ->add('dommageMin')
            ->add('dommageMax')
            ->add('pdv')
            ->add('initiative')
            ->add('vitesse')
            ->add('tirs')
            ->add('mana')
            ->add('croissance')
            ->add('moral')
            ->add('chance')
            ->add('pelotons')
            ->add('capacites')
            ->add('coutRessources')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Creature::class,
        ]);
    }
}
