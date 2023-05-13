<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\File;

class UserProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'Mettre à jour votre Email',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un email.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre email doit faire au minimum {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/',
                        'message' => 'Votre email doit être valide'
                    ])
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mettre à jour votre mot de passe',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    // new NotBlank([
                    //     'message' => 'Entrez un mot de passe.',
                    // ]),
                    new Length([
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                        'message' => 'Votre mot de passe doit contenir au moins 6 caractères dont une majuscule, une minuscule et un chiffre'
                    ])
                ],
            ])
            ->add('username', null, [
                'label' => 'Mettre à jour votre Pseudo',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Pseudo'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un nom d\'utilisateur.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom d\'utilisateur doit faire au minimum {{ limit }} caractères.',
                        'max' => 60,
                        'maxMessage' => 'Votre nom d\'utilisateur doit faire au maximum {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9_-]+$/',
                        'message' => 'Votre nom d\'utilisateur ne doit contenir que des lettres, des chiffres, des tirets et des underscores'
                    ])
                ],
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Parle nous de toi !',
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
            ->add('sports', null, [
                'label' => 'Vos sports',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Sport'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Votre description doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre description ne doit pas dépasser {{ limit }} caractères'
                    ]),
                ]
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
