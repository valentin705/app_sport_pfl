<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Commentaire',
                    'class' => 'mb-3 form-contenu'
                ],
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\Length([
                        'min' => 2,
                        'max' => 300,
                        'minMessage' => 'Votre commentaire doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre commentaire ne doit pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
