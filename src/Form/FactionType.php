<?php

namespace App\Form;

use App\Entity\Faction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomFaction')
            ->add('typeHero')
            ->add('description')
            ->add('competence')
            ->add('specialisationVille')
            ->add('villes')
            ->add('heros')
            ->add('creatures')
            ->add('magiesPreferees')
            ->add('specialisationsHero')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Faction::class,
        ]);
    }
}
