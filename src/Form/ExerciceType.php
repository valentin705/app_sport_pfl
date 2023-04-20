<?php

namespace App\Form;

use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'exercice'
            ])
            ->add('picture', null, [
                'label' => 'Image'
            ])
            ->add('description', null, [
                'label' => 'Description de l\'exercice'
            ])
            ->add('serie', null, [
                'label' => 'Nombre de série'
            ])
            ->add('repetition', null, [
                'label' => 'Nombre de répétition'
            ])
            ->add('temps', null, [
                'label' => 'Temps d\'exécution'
            ])
            ->add('recuperation', null, [
                'label' => 'Temps de récupération'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,

        ]);
    }
}
