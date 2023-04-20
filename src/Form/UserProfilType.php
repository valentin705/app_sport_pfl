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
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('description', null, [
                'label' => 'Votre description',
                'attr' => [
                    'placeholder' => 'Description'
                ]
            ])
            ->add('sports', null, [
                'label' => 'Vos sports',
                'attr' => [
                    'placeholder' => 'Sport'
                ]
            ])
            ->add('picture', null, [
                'label' => 'Lien de votre photo de profil',
                'attr' => [
                    'placeholder' => 'Photo'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
