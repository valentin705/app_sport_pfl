<?php

namespace App\Form;

use App\Entity\Seance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use App\Entity\Exercice;
use App\Form\ExerciceType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SeanceExercicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', null, [
            'attr' => [
                'class' => 'form-control mb-3',
            ]
        ])
        ->add('picture', null, [
            'label' => 'Image',
            'attr' => [
                'class' => 'form-control mb-3',
                'placeholder' => 'lien de l\'image'
            ]
        ])
        ->add('description', null, [
            'label' => 'Description',
            'attr' => [
                'class' => 'form-control mb-3',
                'placeholder' => 'Description de ta séance',
                'rows' => '4',
                'cols' => '10'
            ]
        ])
        ->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
            'by_reference' => false,
            'attr' => [
                'class' => 'form-check'
            ]
        ])
            ->add('exercices', CollectionType::class, [
                'entry_type' => ExerciceType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}

