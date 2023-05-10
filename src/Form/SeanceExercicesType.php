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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class SeanceExercicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom de ta séance'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un nom de séance.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom de séance doit contenir au moins {{ limit }} caractères',
                        'max' => 180,
                        'maxMessage' => 'Votre nom de séance ne doit pas dépasser {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('pictureType', HiddenType::class, [
                'mapped' => false,
                'data' => 'seance'
            ])
            ->add('pictureFile', FileType::class, [
                'label' => 'Photo de profil (JPG, PNG, GIF, JPEG)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Photo'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Votre photo ne doit pas dépasser 1Mo',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Votre photo doit être au format JPG, JPEG ou PNG'
                    ])
                ]
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Description de ta séance',
                    'rows' => '4',
                    'cols' => '10'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 500,
                        'minMessage' => 'Votre description doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre description ne doit pas dépasser {{ limit }} caractères'
                    ]),
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
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
