<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'Mettre à jour votre Email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ]
            ])
            // ->add('password', null, [
            //     'label' => 'Mettre à jour votre Mot de passe',
            //     'attr' => [
            //         'placeholder' => 'Mot de passe'
            //     ]
            // ])
            ->add('username', null, [
                'label' => 'Mettre à jour votre Pseudo',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('description', null, [
                'label' => 'Votre description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description',
                    'rows' => '4',
                    'cols' => '10'
                ]
            ])
            ->add('sports', null, [
                'label' => 'Vos sports',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sport'
                ]
            ])
            ->add('picture', null, [
                'label' => 'Lien de votre photo de profil',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Photo'
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
