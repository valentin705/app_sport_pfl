<?php

namespace App\Form;

use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'exercice',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom de l\'exercice'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 180,
                        'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre nom ne doit pas dépasser {{ limit }} caractères'
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez renseigner un nom d\'exercice'
                    ])
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
                'label' => 'Description de l\'exercice',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Description de l\'exercice',
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
            ->add('serie', null, [
                'label' => 'Nombre de série',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "4"'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un nombre de répétition'
                    ]),
                    new Length([
                        'min' => 1,
                        'max' => 5,
                        'minMessage' => 'Votre nombre de répétition doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre nombre de répétition ne doit pas dépasser {{ limit }} caractères'
                    ]),
                    new Positive([
                        'message' => 'Veuillez renseigner un nombre positif'
                    ])
                ]
            ])
            ->add('repetition', null, [
                'label' => 'Nombre de répétition',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "12"'
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'max' => 5,
                        'minMessage' => 'Votre nombre de répétition doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre nombre de répétition ne doit pas dépasser {{ limit }} caractères'
                    ]),
                    new Positive([
                        'message' => 'Veuillez renseigner un nombre positif'
                    ])
                ]
            ])
            ->add('temps', null, [
                'label' => 'Temps d\'exécution (en secondes)',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "30"'
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'max' => 5,
                        'minMessage' => 'Votre temps d\'exécution doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre temps d\'exécution ne doit pas dépasser {{ limit }} caractères'
                    ]),
                    new Positive([
                        'message' => 'Veuillez renseigner un nombre positif'
                    ])
                ]
            ])
            ->add('recuperation', null, [
                'label' => 'Temps de récupération (en secondes)',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'exemple "90"'
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'max' => 5,
                        'minMessage' => 'Votre temps de récupération doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre temps de récupération ne doit pas dépasser {{ limit }} caractères'
                    ]),
                    new Positive([
                        'message' => 'Veuillez renseigner un nombre positif'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,

        ]);
    }
}
