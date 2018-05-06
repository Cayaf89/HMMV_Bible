<?php

namespace App\Form;

use App\Entity\Hero;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeroType extends AbstractType
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
            ->add('mana')
            ->add('moral')
            ->add('chance')
            ->add('capaciteHero')
            ->add('competences')
            ->add('capacites')
            ->add('armee')
            ->add('sortsDepart')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hero::class,
        ]);
    }
}
